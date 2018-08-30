<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorGruposTrabajo;
use app\models\GestorObras;
use app\models\Obras;
use app\models\ObrasBuscar;



class ObrasController extends Controller
{   
    public function actionListar()
    {
        
        $gestor = new GestorObras;
        $searchModel = new ObrasBuscar;
        $estados = $gestor->Estados();
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $localidades = $gestor->ListarLocalidades();
        $listDataL = ArrayHelper::map($localidades,'IdLocalidad','Localidad');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pObra = $searchModel['Obra'];
            $pIdLocalidad= $searchModel['Localidad'][0];
            $pDireccion = $searchModel['Direccion'];
            $pIdEstado = $searchModel['Estado'];
            $pEstado = $estados[$pIdEstado];
            $obras = $gestor->Buscar($pObra, $pIdLocalidad, $pDireccion, $pEstado, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $obras,
                'pagination' => ['pagesize' => 5,],
            ]);
            //var_dump($searchModel['Localidad'][0]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataL' => $listDataL, 'estados' => $estados]);
        }
        else{
            $obras = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $obras,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataL' => $listDataL, 'estados' => $estados]);
        }
    }
    
    
    public function actionAlta()
    {
        $model = new Obras;
        $gestor = new GestorObras;
        $localidades = $gestor->ListarLocalidades();
        $listData = ArrayHelper::map($localidades, 'IdLocalidad', 'Localidad');
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pIdLocalidad = $model->IdLocalidad;
            $pObra = $model->Obra;
            $pDireccion = $model->Direccion;
            $pPropietario = $model->Propietario;
            $pTelefono = $model->Telefono;
            $pEmail = $model->Email;
            $pComentarios = $model->Comentarios;
            $pSuperficieTerreno = $model->SuperficieTerreno;
            $pSuperficieCubiertaTotal = $model->SuperficieCubiertaTotal;
            $mensaje = $gestor->Alta($pIdGT, $pIdLocalidad, $pObra, $pDireccion, $pPropietario, $pTelefono, $pEmail, $pComentarios, $pSuperficieTerreno, $pSuperficieCubiertaTotal);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/obras/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('alta',['model' => $model, 'listData' => $listData]);
            }
        }
        else{
            return $this->renderAjax('alta',['model' => $model, 'listData' => $listData]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Obras;
        $gestor = new GestorObras;
        $pIdObra = Yii::$app->request->get('IdObra');
        $obra = $gestor->Dame($pIdObra);
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pObra = $model->Obra;
            $pDireccion = $model->Direccion;
            $pPropietario = $model->Propietario;
            $pTelefono = $model->Telefono;
            $pEmail = $model->Email;
            $pComentarios = $model->Comentarios;
            $pSuperficieTerreno = $model->SuperficieTerreno;
            $pSuperficieCubiertaTotal = $model->SuperficieCubiertaTotal;
            $mensaje = $gestor->Modificar($pIdObra, $pObra, $pDireccion, $pPropietario, $pTelefono, $pEmail, $pComentarios, $pSuperficieTerreno, $pSuperficieCubiertaTotal);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/obras/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar',['model' => $model, 'obra' => $obra]);
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'obra' => $obra]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorObras;
        $pIdObra = Yii::$app->request->get('IdObra');
        $mensaje = $gestor->Borrar($pIdObra);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
    }

    public function actionBaja()
    {
        $gestor = new GestorObras;
        $pIdObra = Yii::$app->request->get('IdObra');
        $mensaje = $gestor->Baja($pIdObra);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
    }
    
    public function actionActivar()
    {
        $gestor = new GestorObras;
        $pIdObra = Yii::$app->request->get('IdObra');
        $mensaje = $gestor->Activar($pIdObra);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
    }
    
    public function actionFinalizar()
    {
        $gestor = new GestorObras;
        $pIdObra = Yii::$app->request->get('IdObra');
        $mensaje = $gestor->Finalizar($pIdObra);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/obras/listar');
         }
    }
    
}
