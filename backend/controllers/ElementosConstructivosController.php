<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\GestorItems;
use app\models\GestorInsumos;
use app\models\GestorElementosConstructivos;
use app\models\Elementosconstructivos;
use app\models\ElementosConstructivosBuscar;
use yii\helpers\ArrayHelper;
use app\models\Composicionec;
use kartik\mpdf\Pdf;


class ElementosConstructivosController extends Controller
{
    public function actionListar() {   
        $gestor = new GestorElementosConstructivos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $searchModel = new ElementosConstructivosBuscar;
        $rubrosec = $gestor->ListarRubrosEC();
        $listDataREC = ArrayHelper::map($rubrosec, 'IdRubroEC', 'RubroEC');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()){
            $pElemento = $searchModel['ElementoConstructivo'];
            $pIdRubroEC = $searchModel['RubroEC'][0];
            $pIdUnidad = $searchModel['Abreviatura'][0];
            $elementos = $gestor->Buscar($pElemento, $pIdRubroEC, $pIdUnidad,$pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $elementos,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listDataREC' => $listDataREC]);
        }
        else{
            $elementos = $gestor->Listar($pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $elementos,
                'pagination' => ['pagesize' => 9,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel,'listDataREC' => $listDataREC]);
        }
    }
 
    public function actionAlta() {
        $model = new Elementosconstructivos;
        $model ->scenario = 'alta-elemento';
        $gestor = new GestorElementosConstructivos;
        $gestori = new GestorInsumos;
        $rubroselementos = $gestor->ListarRubrosEC();
        $listDataREC = ArrayHelper::map($rubroselementos, 'IdRubroEC', 'RubroEC');
        $unidades = $gestori->ListarUnidades();
        $listDataU = ArrayHelper::map($unidades,'IdUnidad','Abreviatura');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pElementoConstructivo= $model->ElementoConstructivo;
            $pIdRubroEC = $model->IdRubroEC;
            $pIdUnidad = $model->IdUnidad;
            $mensaje = $gestor->Alta($pElementoConstructivo, $pIdRubroEC, $pIdUnidad, $pIdGT);
            return $mensaje[0]['Mensaje'];
        }
        else{ 
            return $this->renderAjax('alta',['model' => $model, 'listDataREC' => $listDataREC, 'listDataU' => $listDataU]);
        }
    }
    
 
    public function actionModificar() {
        $model = new Elementosconstructivos;
        $gestor = new GestorElementosConstructivos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElementoConstructivo = Yii::$app->request->get('IdElementoConstructivo');
        $elemento = $gestor->Dame($pIdElementoConstructivo, $pIdGT);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pElementoConstructivo = $model->ElementoConstructivo;
            $mensaje = $gestor->Modificar($pIdElementoConstructivo, $pIdGT, $pElementoConstructivo);
            return $mensaje[0]['Mensaje'];
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'ElementoConstructivo' => $elemento]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorElementosConstructivos();
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElementoConstructivo= Yii::$app->request->get('IdElementoConstructivo');
        $mensaje = $gestor->Borrar($pIdElementoConstructivo, $pIdGT);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/elementos-constructivos/listar');
    }
    
    public function actionAgregarItem() {
        $model = new Composicionec;
        $model-> scenario = 'agregar-item-elemento';
        $gestor = new GestorElementosConstructivos;
        $gestori = new GestorItems;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElementoConstructivo= Yii::$app->request->get('IdElementoConstructivo');
        $items = $gestori->Listar($pIdGT);
        $listDataI = ArrayHelper::map($items,'IdItem','Item');
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIdItem = $model->IdItem;
            $pIncidencia = $model->Incidencia;
            $mensaje = $gestor->AgregarItem($pIdElementoConstructivo, $pIdItem, $pIdGT, $pIncidencia);
            return $mensaje[0]['Mensaje'];
        }
        else{ 
            return $this->renderAjax('agregar-item',['model' => $model, 'listDataI' => $listDataI]);
        }
    }
    
    public function actionBorrarItem() {
        $gestor = new GestorElementosConstructivos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElementoConstructivo = Yii::$app->request->get('IdElementoConstructivo');
        $pIdItem = Yii::$app->request->get('IdItem');
        $mensaje = $gestor->BorrarItem($pIdElementoConstructivo, $pIdItem, $pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/elementos-constructivos/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/elementos-constructivos/listar');
        }
    }
    
    
    public function actionModificarIncidencia() {
        $model = new Composicionec;
        $model -> scenario = 'modificar-incidencia';
        $gestor = new GestorElementosConstructivos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElemento = Yii::$app->request->get('IdElementoConstructivo');
        $pIdItem = Yii::$app->request->get('IdItem');
        $incidencia = $gestor->DameIncidenciaItemElemento($pIdElemento, $pIdItem, $pIdGT);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pIncidencia = $model->Incidencia;
            $mensaje = $gestor->ModificarIncidencia($pIdElemento, $pIdItem, $pIdGT, $pIncidencia);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/elementos-constructivos/listar');
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

    public function actionExportar() {

        $gestor = new GestorElementosConstructivos;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $pIdElementoConstructivo= Yii::$app->request->get('IdElementoConstructivo');
        $elemento= $gestor->DameElementoExportar($pIdElementoConstructivo,$pIdGT);
        $dataProviderElemento = new ArrayDataProvider([
            'allModels' => $elemento,
         ]);
         $items = $gestor->ListarItems($pIdElementoConstructivo, $pIdGT);
         $dataProviderItem = new ArrayDataProvider([
             'allModels' => $items,
         ]);

           $data = $this->renderPartial('exportar',['dataProviderItem' => $dataProviderItem,
           'dataProviderElemento' => $dataProviderElemento]);
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
                'SetHeader' => ['Elemento Constructivo Detallado con sus Items||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

}
