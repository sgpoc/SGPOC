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
        $searchModel = new FamiliasBuscar;
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()){
            $pFamilia = $searchModel['Familia'];
            $familias = $gestor->Buscar($pFamilia, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $familias,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        else{
            $familias = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $familias,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
    }
    
    public function actionListarSubfamilias()
    {    
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request->get('IdFamilia');
        $subfamilias = $gestor->ListarSubfamilias($pIdFamilia);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $subfamilias,
            'pagination' => ['pagesize' => 5,],
        ]);
        return $this->renderAjax('subfamilias',['dataProvider' => $dataProvider]);
    }
    
    
    public function actionAlta()
    {
        $model = new Familias;
        $gestor = new GestorFamilias;
        
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
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
                return $this->renderAjax('alta',['model' => $model]);
            }
        }
        else{
            return $this->renderAjax('alta',['model' => $model]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Familias;
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request->get('IdFamilia');
        $familia = $gestor->Dame($pIdFamilia);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pFamilia = $model->Familia;
            $mensaje = $gestor->Modificar($pIdFamilia, $pFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/familias/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar',['model' => $model, 'familia' => $familia]);
            }     
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'familia' => $familia]);
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
