<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use app\models\GestorProveedores;
use app\models\Proveedores;
use app\models\ProveedoresBuscar;
use kartik\mpdf\pdf;

class ProveedoresController extends Controller
{
    public function actionListar() {
        $gestor = new GestorProveedores;
        $searchModel = new ProveedoresBuscar;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pProveedor = $searchModel['Proveedor'];
            $pDomicilio = $searchModel['Domicilio'];
            $pEmail = $searchModel['Email'];
            $pEstado = $searchModel['Estado'];
            $proveedores = $gestor->Buscar($pProveedor, $pDomicilio, $pEmail, $pEstado, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $proveedores,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        else{
            $proveedores = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $proveedores,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        
    }
    
    public function actionAlta() {
        $model = new Proveedores;
        $gestorp = new GestorProveedores;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pProveedor = $model->Proveedor;
            $pDomicilio = $model->Domicilio;
            $pEmail = $model->Email;
            $pTelefono = $model->Telefono;
            $pCodigoPostal = $model->CodigoPostal;
            $pPaginaWeb = $model->PaginaWEB;
            $mensaje = $gestorp->Alta($pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb, $pIdGT);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model]);
        }
    }
    
    public function actionModificar() {
      
        $model = new Proveedores;
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $proveedor = $gestor->Dame($pIdProveedor);     
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pProveedor = $model->Proveedor;
            $pDomicilio = $model->Domicilio;
            $pEmail = $model->Email;
            $pTelefono = $model->Telefono;
            $pCodigoPostal = $model->CodigoPostal;
            $pPaginaWeb = $model->PaginaWEB;
            $pEstado = $model->Estado;
            $mensaje = $gestor->Modificar($pIdProveedor, $pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb, $pEstado);
            if ((substr($mensaje[0]['Mensaje'], 0, 2)) === 'OK') {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/proveedores/listar');
            }
            else {
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'proveedor' => $proveedor]);
        }
    }
    

    public function actionBorrar() {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Borrar($pIdProveedor);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/proveedores/listar');    
    }
    

    public function actionBaja()
    {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Baja($pIdProveedor);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/proveedores/listar');
    }
    
    public function actionActivar()
    {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Activar($pIdProveedor);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/proveedores/listar');
    }
    
    
    public function actionListarLocalidades()
    {
        $gestorp = new GestorProveedores;
        if (isset($_POST['depdrop_parents'])) 
        {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) 
            {    
                $pIdProveedor = $parents[0];        
                $localidades = $gestorp->ListarLocalidades($pIdProveedor);
                echo Json::encode(['output' => $localidades, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' =>'']);
    }

    public function actionExportar() {
        $gestor = new GestorProveedores;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $proveedores = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $proveedores,
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
                'SetHeader' => ['Proveedores||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
     }
}
       
    
    
  
    

