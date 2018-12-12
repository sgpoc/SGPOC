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
use kartik\mpdf\pdf;
use app\models\Familias;



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
    
    public function actionListarInsumos()
    {    
        $gestor = new GestorSubFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $insumos = $gestor->ListarInsumos($pIdSubFamilia, $pIdGT);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $insumos,
            'pagination' => ['pagesize' => 5,],
        ]);
        return $this->renderAjax('insumos',['dataProvider' => $dataProvider]);
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
            $mensaje = $gestors->Alta($pIdFamilia, $pIdGT, $pSubFamilia);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model,'listData' => $listDataF]);
        }
    }
    
    public function actionModificar()
    {  
        $model = new SubFamilias;
        $gestor = new GestorSubFamilias;
        $gestorf = new GestorFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $familia = $gestorf->Listar($pIdGT);
        $listDataF= ArrayHelper::map($familia,'IdFamilia','Familia');
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $subfamilia = $gestor->Dame($pIdSubFamilia, $pIdGT);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pSubFamilia = $model->SubFamilia;
            $pIdFamilia = $model->IdFamilia;
            $mensaje = $gestor->Modificar($pIdSubFamilia, $pSubFamilia,$pIdFamilia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert', $mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
          return $this->renderAjax('modificar',['model' => $model, 'subfamilia' => $subfamilia,'listData' => $listDataF]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorSubFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdSubFamilia = Yii::$app->request->get('IdSubFamilia');
        $mensaje = $gestor->Borrar($pIdSubFamilia, $pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/subfamilias/listar');
         }
    }

    public function actionExportar() {
        $gestor = new GestorSubFamilias;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $subfamilias = $gestor->Listar($pIdGT);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $subfamilias,
        ]);
           $data = $this->renderPartial('exportar',['dataProvider' => $dataProvider]);
           Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
           $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'destination' => Pdf::DEST_BROWSER,
            'content' => $data,
            'options' => [
                
            ],
            'methods' => [
                'SetTitle' => 'Familias',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['SubFamilias||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
     }
    
}
