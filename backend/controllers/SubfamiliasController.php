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
        $gestorf = new GestorFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $searchModel = new SubFamiliaBuscar;
        $familias = $gestorf->Listar($pIdGT);
        $listData = ArrayHelper::map($familias,'IdFamilia','Familia');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pSubFamilia = $searchModel['SubFamilia'];
            $pIdFamilia = $searchModel['Familia'][0];
            $subfamilias = $gestor->Buscar($pSubFamilia, $pIdFamilia, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $subfamilias,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listData' => $listData]);
        }
        else{
            $subfamilias = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $subfamilias,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listData' => $listData]);
        }
    }

    
    
    public function actionAlta()
    {
        $model = new Subfamilias;
        $model->scenario = 'alta-subfamilia';
        $gestors = new GestorSubFamilias;
        $gestorf = new GestorFamilias();
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $familia = $gestorf->Listar($pIdGT);
        $listDataF= ArrayHelper::map($familia,'IdFamilia','Familia');     
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
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
                return $this->renderAjax('alta',['model' => $model,'listData' => $listDataF]);
            }
        }
        else{
            return $this->renderAjax('alta',['model' => $model,'listData' => $listDataF]);
        }
    }
    
    public function actionModificar()
    {
        $model = new SubFamilias;
        $gestor = new GestorSubFamilias;
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $subfamilia = $gestor->Dame($pIdSubFamilia);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pSubFamilia = $model->SubFamilia;
            $mensaje = $gestor->Modificar($pIdSubFamilia, $pSubFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar',['model' => $model, 'subfamilia' => $subfamilia]);
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'subfamilia' => $subfamilia]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorSubFamilias;
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $mensaje = $gestor->Borrar($pIdSubFamilia);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
    }
    
}
