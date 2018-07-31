<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\GestorFamilias;
use app\models\Familias;
use app\models\FamiliasBuscar;


class FamiliasController extends Controller
{
    public function actionListar()
    {   
        $gestor = new GestorFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $familias = $gestor->Listar($pIdGT);
        //$searchModel = new FamiliasBuscar;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $familias,
            'pagination' => ['pagesize' => 5,],
        ]);
        return $this->render('listar',['dataProvider' => $dataProvider]);//, 'searchModel' => $searchModel]);
    }
    
    public function actionListarSubfamilias()
    {    
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request-get>'IdFamilia';
        $subfamilias = $gestor->ListarSubfamilias($pIdFamilia);
        $dataProvider = new ArrayDataProvider([
              'allModels' => $subfamilias,
              'pagination' => ['pagesize' => 5,],
        ]);
        return $this->render('//subfamilias/listar',['dataProvider' => $dataProvider]);
        
    }
    
    public function actionBuscar()
    {
        $model = new FamiliasBuscar;
        $gestor = new GestorFamilias;
    
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pCadena = $model->pCadena;
            $familias = $gestor->Buscar($pCadena);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $familias,
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
        $model = new Familias;
        $gestor = new GestorFamilias;
        
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pFamilia = $model->Familia;
            $mensaje = $gestor->Alta($pIdGT, $pFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/familias/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->render('alta',['model' => $model]);
            }
        }
        else{
            return $this->render('alta',['model' => $model]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Familias;
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request->get('IdFamilia');
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pFamilia = $model->Familia;
            $mensaje = $gestor->Modificar($pIdFamilia, $pFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/familias/listar');
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
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request->get('IdFamilia');
        $mensaje = $gestor->Borrar($pIdFamilia);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/familias/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/familias/listar');
        }
    }
    
}
