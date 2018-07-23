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
    public function actionIndex()
    {
        
    }
    
    public function actionListar()
    {   
        $gestor = new GestorFamilias;
        $familias = $gestor->Listar();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $familias,
            'pagination' => ['pagesize' => 10,],
        ]);
        return $this->render('listar',['dataProvider' => $dataProvider]);
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
            return $this->redirect('/sgpoc/backend/web/familias/listar'); 
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
            return $this->redirect('/sgpoc/backend/web/familias/listar');
             
        }
        else{
           return $this->render('modificar',['model' => $model]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorFamilias;
        $pIdFamilia = Yii::$app->request->get('IdFamilia');
        $gestor->Borrar($pIdFamilia);
        return $this->redirect('/sgpoc/backend/web/familias/listar');
    }
    
}
