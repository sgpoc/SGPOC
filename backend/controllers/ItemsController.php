<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorInsumos;
use app\models\GestorItems;
use app\models\Items;
use app\models\ItemsBuscar;
use app\models\ComposicionItem;


class ItemsController extends Controller
{   
    public function actionListar()
    {
        
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $searchModel = new ItemsBuscar;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $unidades = $gestori->ListarUnidades();
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        $rubrositem = $gestor->ListarRubrosItem();
        $listDataRI = ArrayHelper::map($rubrositem,'IdRubroItem','RubroItem');
        if(Yii::$app->request->post('hasEditable'))
        {
            return $this->redirect('/sgpoc/backend/web/items/modificar-incidencia');
        }
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pItem = $searchModel['Item'];
            $pIdRubroItem = $searchModel['RubroItem'][0];
            $pIdUnidad = $searchModel['Abreviatura'][0];
            $items = $gestor->Buscar($pItem, $pIdRubroItem, $pIdUnidad, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $items,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataRI' => $listDataRI]);
        }
        else{
            $items = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $items,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataRI' => $listDataRI]);
        }
    }
    
    
    public function actionAlta()
    {
        $model = new Items;
        $model->scenario = 'alta-item';
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $rubrositem = $gestor->ListarRubrosItem();
        $listDataRI = ArrayHelper::map($rubrositem, 'IdRubroItem', 'RubroItem');
        $unidades = $gestori->ListarUnidades();
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pItem= $model->Item;
            $pIdRubroItem = $model->IdRubroItem;
            $pIdUnidad = $model->IdUnidad;
            $mensaje = $gestor->Alta($pItem, $pIdRubroItem, $pIdUnidad, $pIdGT);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('alta',['model' => $model, 'listDataRI' => $listDataRI, 'listDataU' => $listDataU]);
            }
        }
        else{ 
            return $this->renderAjax('alta',['model' => $model, 'listDataRI' => $listDataRI, 'listDataU' => $listDataU]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Items;
        $gestor = new GestorItems;
        $pIdItem = Yii::$app->request->get('IdItem');
        $item = $gestor->Dame($pIdItem);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pItem = $model->Item;
            $mensaje = $gestor->Modificar($pIdItem, $pItem);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar',['model' => $model, 'item' => $item]);
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'obra' => $item]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorItems;
        $pIdItem= Yii::$app->request->get('IdItem');
        $mensaje = $gestor->Borrar($pIdItem);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/items/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/items/listar');
         }
    }
    
    public function actionAgregarInsumo()
    {
        $model = new ComposicionItem;
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem= Yii::$app->request->get('IdItem');
        $insumos = $gestori->Listar($pIdGT);
        $listDataI = ArrayHelper::map($insumos,'IdInsumo','Insumo');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIdInsumo = $model->IdInsumo;
            $pIncidencia = $model->Incidencia;
            $mensaje = $gestor->AgregarInsumo($pIdItem, $pIdInsumo, $pIncidencia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('agregar-insumo',['model' => $model, 'listDataI' => $listDataI]);
            }
        }
        else{ 
            return $this->renderAjax('agregar-insumo',['model' => $model, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionModificarIncidencia()
    {
        $model = new ComposicionItem;
        $gestor = new GestorItems;
        $pIdItem = Yii::$app->request->get('IdItem');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIncidencia = $model->Incidencia;
            $mensaje = $gestor->ModificarIncidencia($pIdItem, $pIdInsumo, $pIncidencia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar-incidencia',['model' => $model]);
            }
        }
        else{ 
            return $this->renderAjax('modificar-incidencia',['model' => $model]);
        }
    }
    
    public function actionBorrarInsumo()
    {
        $gestor = new GestorItems;
        $pIdItem = Yii::$app->request->get('IdItem');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        $mensaje = $gestor->BorrarInsumo($pIdItem, $pIdInsumo);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/items/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/items/listar');;
        }
    }
    
}
