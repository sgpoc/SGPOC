<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\GestorProveedores;
use app\models\Proveedores;
use app\models\ProveedoresBuscar;


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
    
    public function actionAlta()
    {
        $model = new Proveedores;
        $gestorp = new GestorProveedores;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pProveedor = $model->Proveedor;
            $pDomicilio = $model->Domicilio;
            $pEmail = $model->Email;
            $pTelefono = $model->Telefono;
            $pCodigoPostal = $model->CodigoPostal;
            $pPaginaWeb = $model->PaginaWEB;
            $mensaje = $gestorp->Alta($pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb, $pIdGT);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/proveedores/listar');
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
    
    public function actionModificar(){
      
        $model = new Proveedores;
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $proveedor = $gestor->Dame($pIdProveedor);       
        if($model->load(Yii::$app->request->post() && $model->validate()))
        {
            $pProveedor = $model->Proveedor;
            $pDomicilio = $model->Apellido;
            $pEmail = $model->Email;
            $pTelefono = $model->Telefono;
            $pCodigoPostal = $model->CodigoPostal;
            $pPaginaWeb = $model->PaginaWEB;
            $pEstado = $model->Estado;
            $mensaje = $gestor->Modificar($pIdProveedor,$pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb, $pEstado);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/proveedores/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar',['model' => $model]);
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'proveedor' => $proveedor]);
        }
    }
    

    public function actionBorrar()
    {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Borrar($pIdProveedor);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
    }

    public function actionBaja()
    {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Baja($pIdProveedor);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
        return $this->redirect('/sgpoc/backend/web/proveedores/listar');
    }
    
    public function actionActivar()
    {
        $gestor = new GestorProveedores;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $mensaje = $gestor->Activar($pIdProveedor);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/proveedores/listar');
         }
    }
    
    
    
}
       
    
    
  
    

