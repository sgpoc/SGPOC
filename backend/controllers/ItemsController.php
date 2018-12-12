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
use kartik\mpdf\Pdf;



class ItemsController extends Controller
{   
    public function actionListar() {
        
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
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataRI' => $listDataRI]);
        }
        else{
            $items = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $items,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataU' => $listDataU, 'listDataRI' => $listDataRI]);
        }
    }
    
    
    public function actionAlta() {
        $model = new Items;
        $model->scenario = 'alta-item';
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $rubrositem = $gestor->ListarRubrosItem();
        $listDataRI = ArrayHelper::map($rubrositem, 'IdRubroItem', 'RubroItem');
        $unidades = $gestori->ListarUnidades();
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pItem= $model->Item;
            $pIdRubroItem = $model->IdRubroItem;
            $pIdUnidad = $model->IdUnidad;
            $mensaje = $gestor->Alta($pItem, $pIdRubroItem, $pIdUnidad, $pIdGT);
            return $mensaje[0]['Mensaje'];
        }
        else{ 
            return $this->renderAjax('alta',['model' => $model, 'listDataRI' => $listDataRI, 'listDataU' => $listDataU]);
        }
    }
    
    public function actionModificar() {
        $model = new Items;
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $rubrositem = $gestor->ListarRubrosItem();
        $listDataRI = ArrayHelper::map($rubrositem, 'IdRubroItem', 'RubroItem');
        $unidades = $gestori->ListarUnidades();
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem = Yii::$app->request->get('IdItem');
        $item = $gestor->Dame($pIdItem,$pIdGT);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pItem = $model->Item;
            $pIdRubroItem = $model->IdRubroItem;
            $pIdUnidad = $model->IdUnidad;
            $mensaje = $gestor->Modificar($pIdItem,$pIdGT, $pItem, $pIdRubroItem, $pIdUnidad);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'item' => $item,  'listDataRI' => $listDataRI, 'listDataU' => $listDataU]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorItems;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem= Yii::$app->request->get('IdItem');
        $mensaje = $gestor->Borrar($pIdItem, $pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
         {
            return $this->redirect('/sgpoc/backend/web/items/listar');
         }
         else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/items/listar');
         }
    }
    
    public function actionAgregarInsumo() {
        $model = new ComposicionItem;
        $model -> scenario = 'agregar-insumo-item';
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
            $mensaje = $gestor->AgregarInsumo($pIdItem, $pIdInsumo, $pIdGT, $pIncidencia);
            return $mensaje[0]['Mensaje'];
        }
        else{ 
            return $this->renderAjax('agregar-insumo',['model' => $model, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionModificarIncidencia() {
        $model = new ComposicionItem;
        $model -> scenario = 'modificar-incidencia';
        $gestor = new GestorItems;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem = Yii::$app->request->get('IdItem');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        $incidencia = $gestor->DameIncidenciaInsumoItem($pIdItem, $pIdInsumo, $pIdGT);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIncidencia = $model->Incidencia;
            $mensaje = $gestor->ModificarIncidencia($pIdItem, $pIdInsumo, $pIdGT, $pIncidencia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/items/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('modificar-incidencia',['model' => $model, 'incidencia' => $incidencia]);
            }
        }
        else{ 
            return $this->renderAjax('modificar-incidencia',['model' => $model, 'incidencia' => $incidencia]);
        }
    }
    
    public function actionBorrarInsumo() {
        $gestor = new GestorItems;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem = Yii::$app->request->get('IdItem');
        $pIdInsumo = Yii::$app->request->get('IdInsumo');
        $mensaje = $gestor->BorrarInsumo($pIdItem, $pIdInsumo, $pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/items/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/items/listar');;
        }
    }

    public function actionExportar() {
        $gestor = new GestorItems;
        $gestori = new GestorInsumos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem= Yii::$app->request->get('IdItem');
        $unidades = $gestori->ListarUnidades();
        $item= $gestor->DameRubroItemUnidad($pIdItem,$pIdGT);
        $dataProviderItem = new ArrayDataProvider([
            'allModels' => $item,
         ]);
                $gestor = new GestorItems;
                $insumos = $gestor->ListarInsumos($pIdItem, $pIdGT);
                $dataProviderInsumos = new ArrayDataProvider([
                    'allModels' => $insumos,
                ]);

           $data = $this->renderPartial('exportar',['dataProviderInsumos' => $dataProviderInsumos,
           'dataProviderItem' => $dataProviderItem]);
           Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
           $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'destination' => Pdf::DEST_BROWSER,
            'content' => $data,
            'options' => [
              
            ],
            'methods' => [
                'SetTitle' => 'Item Detallado',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Item||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

    public function actionExportarTodo() {
        $gestor = new GestorItems;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $item= $gestor->Listar($pIdGT);
        $dataProviderItem = new ArrayDataProvider([
            'allModels' => $item,
         ]);
           $data = $this->renderPartial('exportar-todo',['dataProviderItem' => $dataProviderItem]);
           Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
           $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'destination' => Pdf::DEST_BROWSER,
            'content' => $data,
            'options' => [
              
            ],
            'methods' => [
                'SetTitle' => 'Item Detallado',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Item||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

}

