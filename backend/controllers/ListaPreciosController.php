<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorListaPrecios;
use app\models\GestorInsumos;
use app\models\GestorFamilias;
use app\models\GestorSubFamilias;
use app\models\InsumosBuscar;
use app\models\ListaPrecios;


class ListaPreciosController extends Controller
{
    public function actionListar()
    {
        $model = new ListaPrecios;
        $gestorlp = new GestorListaPrecios;
        $proveedores = $gestorlp->ListarProveedores();
        $localidades = $gestorlp->ListarLocalidades();
        $listDataP = ArrayHelper::map($proveedores,'IdProveedor','Proveedor');
        $listDataL = ArrayHelper::map($localidades,'IdLocalidad','Localidad');
        if(Yii::$app->request->post())
        {
            $array = Yii::$app->request->post();
            $pIdProveedor = $array['Listaprecios']['IdProveedor'];
            $pIdLocalidad = $array['Listaprecios']['IdLocalidad'];
            $gestori = new GestorInsumos;
            $gestorf = new GestorFamilias;
            $gestorsf = new GestorSubFamilias;
            $searchModel = new InsumosBuscar;
            $unidades = $gestori->ListarUnidades();
            $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $familias = $gestorf->Listar($pIdGT);
            $listDataF = ArrayHelper::map($familias,'IdFamilia','Familia');
            $subfamilias = $gestorsf->Listar($pIdGT);
            $listDataSF = ArrayHelper::map($subfamilias,'IdSubFamilia','SubFamilia');
            if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
            {
                $pInsumo = $searchModel['Insumo'];
                $pTipoInsumo = $searchModel['TipoInsumo'];
                $pIdFamilia = $searchModel['Familia'][0];
                $pIdSubFamilia = $searchModel['SubFamilia'][0];
                $pIdUnidad = $searchModel['Abreviatura'][0];
                $insumos = $gestorlp->Buscar($pInsumo, $pTipoInsumo, $pIdFamilia, $pIdSubFamilia, $pIdUnidad, $pIdProveedor, $pIdLocalidad, $pIdGT);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $insumos,
                    'pagination' => ['pagesize' => 5,],
                ]);
                return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataF' => $listDataF, 'listDataSF' => $listDataSF]);
            }
            else{
                $insumos = $gestorlp->Listar($pIdProveedor, $pIdLocalidad, $pIdGT);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $insumos,
                    'pagination' => ['pagesize' => 5,],
                ]);
                return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataF' => $listDataF, 'listDataSF' => $listDataSF]);
            }
        }    
        else{
            return $this->render('eleccion',['model' => $model,'listDataP' => $listDataP, 'listDataL' => $listDataL]);
        }   
    }
    
    public function actionAgregar()
    {
        $model = new ListaPrecios;
        $gestorlp = new GestorListaPrecios;
        $gestori = new GestorInsumos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $insumos = $gestori->Listar($pIdGT);
        $listDataI= ArrayHelper::map($insumos,'IdInsumo','Insumo');
        //$array = Yii::$app->request->post();
        //$pIdProveedor = $array['Listaprecios']['IdProveedor'];
        //$pIdLocalidad = $array['Listaprecios']['IdLocalidad'];
        if($model->load(Yii::$app->request->post()))// && $model->validate())
        {
            $pIdInsumo = $model->IdInsumo;
            $pIdProveedor;
            $pIdLocalidad;
            $pPrecioLista = $model->PrecioLista;
            $pFechaUltimaActualizacion = $model->FechaUltimaActualizacion;
            $mensaje = $gestorlp->Agregar($pIdInsumo, $pIdProveedor, $pIdLocalidad, $pPrecioLista, $pFechaUltimaActualizacion, $pIdGT);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('agregar',['model' => $model]);
            }
        }
        else{
            //var_dump(Yii::$app->request->post());
            return $this->renderAjax('agregar',['model' => $model, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionModificar()
    {
        $model = new GruposTrabajo;
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pGrupoTrabajo = $model->GrupoTrabajo;
            $pMail = $model->Mail;
            $mensaje = $gestor->Modificar($pIdGT, $pGrupoTrabajo, $pMail);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);            
                return $this->renderAjax('modificar',['model' => $model]);
            }
        }
        else{
            return $this->renderAjax('modificar',['model' => $model]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Borrar($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        
    }

    public function actionBaja()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Baja($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
    }
    
    public function actionActivar()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Activar($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
    }
    
}
