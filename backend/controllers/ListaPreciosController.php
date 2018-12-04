<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorListaPrecios;
use app\models\ListaPreciosBuscar;
use app\models\GestorInsumos;
use app\models\GestorProveedores;
use app\models\ListaPrecios;


class ListaPreciosController extends Controller
{
    public function actionListar() {
        $searchModel = new ListaPreciosBuscar;
        $gestorlp = new GestorListaPrecios;
        $gestorp = new GestorProveedores;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $localidades = $gestorlp->ListarLocalidades();
        $listDataL = ArrayHelper::map($localidades,'IdLocalidad','Localidad');
        $proveedores = $gestorp->Listar($pIdGT);
        $listDataP = ArrayHelper::map($proveedores,'IdProveedor','Proveedor');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pIdProveedor = $searchModel['Proveedor'][0];
            $pIdLocalidad = $searchModel['Localidad'][0];
            $listaprecios = $gestorlp->Buscar($pIdProveedor, $pIdLocalidad, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $listaprecios,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataP' => $listDataP, 'listDataL' => $listDataL]);
        }
        else{
            $listaprecios = $gestorlp->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $listaprecios,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataP' => $listDataP, 'listDataL' => $listDataL]);
        }  
    }
    
    public function actionAlta() {
        $model = new ListaPrecios;
        $model->scenario = 'alta-lista';
        $gestorlp = new GestorListaPrecios;
        $gestorp = new GestorProveedores;
        $gestori = new GestorInsumos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $insumos = $gestori->Listar($pIdGT);
        $listDataI= ArrayHelper::map($insumos,'IdInsumo','Insumo');
        $proveedores = $gestorp->Listar($pIdGT);
        $listDataP = ArrayHelper::map($proveedores,'IdProveedor','Proveedor');
        $localidades = $gestorlp->ListarLocalidades();
        $listDataL = ArrayHelper::map($localidades,'IdLocalidad','Localidad');
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pIdProveedor = $model->IdProveedor;
            $pIdLocalidad = $model->IdLocalidad;
            $pIdInsumo = $model->IdInsumo;
            $pPrecioLista = $model->PrecioLista;
            $pFechaUltimaActualizacion = $model->FechaUltimaActualizacion;
            $mensaje = $gestorlp->Alta($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion, $pIdGT);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model, 'listDataP' => $listDataP, 'listDataL' => $listDataL, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorListaPrecios;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $pIdLocalidad = Yii::$app->request->get('IdLocalidad');
        $mensaje = $gestor->Borrar($pIdProveedor,$pIdLocalidad);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/lista-precios/listar');
    }
    
    
    public function actionAgregarInsumo() {
        $model = new ListaPrecios;
        $model->scenario = 'agregar-insumo';
        $gestor = new GestorListaPrecios;
        $gestori = new GestorInsumos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $pIdLocalidad = Yii::$app->request->get('IdLocalidad');
        $insumos = $gestori->Listar($pIdGT);
        $listDataI = ArrayHelper::map($insumos,'IdInsumo','Insumo');
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pIdInsumo = $model->IdInsumo;
            $pPrecioLista = $model->PrecioLista;
            $pFechaUltimaActualizacion = $model->FechaUltimaActualizacion;
            $mensaje = $gestor->AgregarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion);
            return $mensaje[0]['Mensaje'];
        }
        else{ 
            return $this->renderAjax('agregar-insumo',['model' => $model, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionBorrarInsumo() {
        $gestor = new GestorListaPrecios;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $pIdLocalidad = Yii::$app->request->get('IdLocalidad');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        $mensaje = $gestor->BorrarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/lista-precios/listar');
    }
    
    public function actionModificarInsumo() {
        $model = new ListaPrecios;
        $model->scenario = 'modificar-insumo';
        $gestor = new GestorListaPrecios;
        $pIdProveedor = Yii::$app->request->get('IdProveedor');
        $pIdLocalidad = Yii::$app->request->get('IdLocalidad');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        $insumo = $gestor->DamePrecioFechaInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo);
        $model->FechaUltimaActualizacion = $insumo[0]['FechaUltimaActualizacion'];
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pPrecioLista = $model->PrecioLista;
            $pFechaUltimaActualizacion = $model->FechaUltimaActualizacion;
            $mensaje = $gestor->ModificarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/lista-precios/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{ 
            return $this->renderAjax('modificar-insumo',['model' => $model, 'Insumo'=>$insumo]);
        }
    }

}
