<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorObras;
use app\models\GestorComputosMetricos;
use app\models\ComputosMetricosBuscar;
use app\models\ComputosMetricos;
use app\models\LineaComputoMetrico;
use app\models\GestorInsumos;
use app\models\GestorItems;
use app\models\GestorElementosConstructivos;
use kartik\mpdf\Pdf;

class ComputosMetricosController extends Controller
{   
    public function actionListar() {
        $gestor = new GestorComputosMetricos;
        $gestoro = new GestorObras;
        $searchModel = new ComputosMetricosBuscar;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $obras = $gestoro->Listar($pIdGT);
        $listDataO = ArrayHelper::map($obras,'IdObra','Obra');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pIdObra= $searchModel['Obra'][0];
            $pDescripcion = $searchModel['Descripcion'];
            $pFechaComputoMetrico = $searchModel['FechaComputoMetrico'];
            $computos = $gestor->Buscar($pIdObra, $pDescripcion, $pFechaComputoMetrico, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $computos,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataO' => $listDataO]);
        }
        else{
            $computos = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $computos,
                'pagination' => ['pagesize' => 9,],
            ]);
             return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataO' => $listDataO]);
        }
    }
    
    
    public function actionAlta() {
        $model = new ComputosMetricos;
        $model->scenario = 'alta-computo';
        $gestor = new GestorComputosMetricos;
        $gestoro = new GestorObras;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $obras = $gestoro->Listar($pIdGT);
        $listDataO = ArrayHelper::map($obras,'IdObra','Obra');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIdObra= $model->IdObra;
            $pDescripcion = $model->Descripcion;
            $pFechaComputoMetrico = $model->FechaComputoMetrico;
            $pTipoComputo = $model->TipoComputo;
            $mensaje = $gestor->Alta($pIdObra, $pDescripcion, $pFechaComputoMetrico, $pTipoComputo);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model, 'listDataO' => $listDataO]);
        }
    }
    
    public function actionModificar() {
        $model = new ComputosMetricos;
        $gestor = new GestorComputosMetricos;
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $computo = $gestor->Dame($pIdComputoMetrico);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pDescripcion = $model->Descripcion;
            $pFechaComputoMetrico = $model->FechaComputoMetrico;
            $pTipoComputo = $model->TipoComputo;            
            $mensaje = $gestor->Modificar($pIdComputoMetrico, $pDescripcion, $pFechaComputoMetrico, $pTipoComputo);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/computos-metricos/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'computo' => $computo]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorComputosMetricos;
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $mensaje = $gestor->Borrar($pIdComputoMetrico);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/computos-metricos/listar');
    }
    
    public function actionAgregarLinea() {
        $model = new LineaComputoMetrico;
        $model->scenario = 'agregar-linea';
        $gestor = new GestorComputosMetricos;
        $gestori = new GestorItems;
        $gestorin = new GestorInsumos;
        $gestorec = new GestorElementosConstructivos;
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdItem= Yii::$app->request->post('IdItem');
        $items = $gestori->Listar($pIdGT);
        $listDataI = ArrayHelper::map($items,'IdItem','Item');
        $elementos = $gestorec->Listar($pIdGT);
        $listDataE = ArrayHelper::map($elementos,'IdElementoConstructivo','ElementoConstructivo');
        $unidades = $gestorin->ListarUnidades($pIdGT);
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        $computo = $gestor->Dame($pIdComputoMetrico);
        $tipoComputo = $computo[0]['TipoComputo'];
        if($tipoComputo == 'I')
        {
            if($model->load(Yii::$app->request->post()) && $model->validate())
            {
                $pIdItem = $model->IdItem;
                $pIdElementoConstructivo = null;
                $pIdUnidad = $model->IdUnidad;
                $pDescripcion = $model->Descripcion;
                $pCantidad = $model->Cantidad;
                $pLargo = $model->Largo;
                $pAncho = $model->Ancho;
                $pAlto = $model->Alto;
                $mensaje = $gestor->AgregarLinea($pIdComputoMetrico, $pIdGT, $pIdElementoConstructivo, $pIdItem, $pIdUnidad, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto);
                return $mensaje[0]['Mensaje'];
            }
            else{ 
                return $this->renderAjax('agregar-item',['model' => $model, 'listDataI' => $listDataI, 'listDataU' => $listDataU]);
            }
        }
        else{
            if($model->load(Yii::$app->request->post()) && $model->validate())
            {
                $pIdElementoConstructivo = $model->IdElementoConstructivo;
                $pIdItem = null;
                $pIdUnidad = $model->IdUnidad;
                $pDescripcion = $model->Descripcion;
                $pCantidad = $model->Cantidad;
                $pLargo = $model->Largo;
                $pAncho = $model->Ancho;
                $pAlto = $model->Alto;
                $mensaje = $gestor->AgregarLinea($pIdComputoMetrico, $pIdGT, $pIdElementoConstructivo, $pIdItem, $pIdUnidad, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto);
                return $mensaje[0]['Mensaje'];
            }
            else{ 
                return $this->renderAjax('agregar-elemento',['model' => $model, 'listDataE' => $listDataE, 'listDataU' => $listDataU]);
            }
        }
    }
    
    public function actionModificarLinea() {
        $model = new LineaComputoMetrico;
        $gestor = new GestorComputosMetricos;
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $pNroLinea = Yii::$app->request->get('NroLinea');
        $lineacomputo = $gestor->DameLinea($pIdComputoMetrico, $pNroLinea);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pDescripcion = $model->Descripcion;
            $pCantidad = $model->Cantidad;
            $pLargo = $model->Largo;
            $pAncho = $model->Ancho;
            $pAlto = $model->Alto;
            $pParcial = $lineacomputo[0]['Parcial'];
            $mensaje = $gestor->ModificarLinea($pIdComputoMetrico, $pNroLinea, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto, $pParcial);
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/computos-metricos/listar');
        }
        else{
            return $this->renderAjax('modificar-linea',['model' => $model, 'lineacomputo' => $lineacomputo]);
        }
    }
    
    public function actionBorrarLinea() {
        $gestor = new GestorComputosMetricos;
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $pNroLinea = Yii::$app->request->get('NroLinea');
        $mensaje = $gestor->BorrarLinea($pIdComputoMetrico, $pNroLinea);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/computos-metricos/listar');
    }

    public function actionExportar() {

        $gestor = new GestorComputosMetricos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdComputoMetrico = Yii::$app->request->get('IdComputoMetrico');
        $tipoComputo = Yii::$app->request->get('tipoComputo');
        $computos = $gestor->DameComputoDeObra($pIdGT,$pIdComputoMetrico); //con el IdComputo metrico puedo saber el IdObra en la tabla composicioncomputometrico
            $dataProviderElemento = new ArrayDataProvider([
                'allModels' => $computos,
                'pagination' => ['pagesize' => 9,],
            ]);
        if( $tipoComputo == 'I'){
            $items = $gestor->ListarItems($pIdComputoMetrico, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $items,
            ]);
        }
        else{
            $elementos = $gestor->ListarElementos($pIdComputoMetrico, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $elementos,
            ]);
        }
           $data = $this->renderPartial('exportar',['dataProviderElemento' => $dataProviderElemento,
           'dataProvider' => $dataProvider, 'tipoComputo' => $tipoComputo]);
           Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
           $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'destination' => Pdf::DEST_BROWSER,
            'content' => $data,
            'options' => [
                
            ],
            'methods' => [
                'SetTitle' => 'Elemento Constructivo',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['Computo Metrico Detallado||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }    
}

