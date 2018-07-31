<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorFamilias;
use app\models\GestorSubFamilias;
use app\models\Subfamilias;
use app\models\SubFamiliaBuscar;



class SubfamiliasController extends Controller
{
    
    public function actionListar()
    {       
        $gestor = new GestorSubFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $subfamilia = $gestor->Listar($pIdGT);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $subfamilia,
            'pagination' => ['pagesize' => 10,],
        ]);
        return $this->render('listar',['dataProvider' => $dataProvider]);
    }
    
    public function actionBuscar()
    {
        $model = new SubFamiliaBuscar;
        $gestor = new GestorSubFamilias;
    
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pCadena = $model->pCadena;
            $subfamilia = $gestor->Buscar($pCadena);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $subfamilia,
                'pagination' => ['pagesize' => 10,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider]);
        }
        else
        {
            return $this->render('buscar',['model' => $model]);
        }
    }
    
    
    public function actionAlta()
    {
        $model = new Subfamilias;
        $gestors = new GestorSubFamilias;
        $gestorf = new GestorFamilias();
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $familia = $gestorf->Listar($pIdGT);
        $listDataF= ArrayHelper::map($familia,'IdFamilia','Familia');
        
        
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIdFamilia = $model->IdFamilia;
            $pSubFamilia = $model->SubFamilia;
            $mensaje = $gestors->Alta($pIdFamilia, $pSubFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->render('alta',['model' => $model,'listData' => $listDataF]);
            }
        }
        else{
            return $this->render('alta',['model' => $model,'listData' => $listDataF]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Subfamilias;
        $gestor = new GestorSubFamilias;
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pSubFamilia = $model->SubFamilia;
            $mensaje = $gestor->Modificar($pIdSubFamilia, $pSubFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->render('modificar',['model' => $model]);
            }
        }
        else{
           return $this->render('modificar',['model' => $model]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorSubFamilias;
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $mensaje = $gestor->Borrar($pIdSubFamilia);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/sufamilias/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
    }

    public function actionBaja()
    {
        $gestor = new GestorSubFamilias;
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $mensaje = $gestor->Baja($pIdSubFamilia);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/usuarios/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
        return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
    }
    
    
    
}
