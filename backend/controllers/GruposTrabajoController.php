<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\GestorGruposTrabajo;
use app\models\GruposTrabajo;
use app\models\GruposTrabajoBuscar;
use app\models\GestorUsuarios;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Usuarios;


class GruposTrabajoController extends Controller
{   
    
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Usuarios::isUserAdmin(Yii::$app->user->identity['IdRol']);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    
    public function actionListar() {       
        $gestor = new GestorGruposTrabajo;
        $searchModel = new GruposTrabajoBuscar;
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pGrupoTrabajo = $searchModel['GrupoTrabajo'];
            $pMail = $searchModel['Mail'];
            $pEstado = $searchModel['Estado'];
            $grupostrabajo = $gestor->Buscar($pGrupoTrabajo, $pMail, $pEstado);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $grupostrabajo,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        else{
            $grupostrabajo = $gestor->Listar();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $grupostrabajo,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
    }
    
    public function actionListarUsuarios() {    
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $usuarios = $gestor->ListarUsuarios($pIdGT);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $usuarios,
            'pagination' => ['pagesize' => 5,],
        ]);
        return $this->renderAjax('usuarios',['dataProvider' => $dataProvider]);
    }
    
    public function actionAlta() {
        $model = new GruposTrabajo;
        $gestor = new GestorGruposTrabajo;
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pGrupoTrabajo = $model->GrupoTrabajo;
            $pMail = $model->Mail;
            $mensaje = $gestor->Alta($pGrupoTrabajo, $pMail);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model]);
        }
    }
    
    public function actionModificar()
    {
        $model = new GruposTrabajo;
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $grupotrabajo = $gestor->Dame($pIdGT);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pGrupoTrabajo = $model->GrupoTrabajo;
            $pMail = $model->Mail;
            $pfechaCreacion = $model->fechaCreacion;
            $mensaje = $gestor->Modificar($pIdGT, $pGrupoTrabajo, $pMail,$pfechaCreacion);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
            return $this->renderAjax('modificar',['model' => $model, 'grupotrabajo' => $grupotrabajo]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Borrar($pIdGT);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
    }

    public function actionBaja() {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Baja($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            return $mensaje[0]['Mensaje'];
        }
    }
    
    public function actionActivar() {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Activar($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            return $mensaje[0]['Mensaje'];
        }
    }
    
}
