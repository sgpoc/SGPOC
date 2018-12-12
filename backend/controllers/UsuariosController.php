<?php
namespace backend\controllers;

use Yii;
use common\models\Usuarios;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorGruposTrabajo;
use app\models\GestorUsuarios;
use app\models\UsuariosBuscar;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use kartik\mpdf\pdf;

class UsuariosController extends Controller
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
                        'roles' => ['@'],/*
                        'matchCallback' => function ($rule, $action) {
                           return Usuarios::isUserAdmin(Yii::$app->user->identity['IdRol']);                 
                        }*/
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

 public function beforeAction($action)
{
  if(Yii::$app->user->identity['IdRol'] == 1)
  {
    return parent::beforeAction($action);
}
  throw new HttpException('403', 'No se tienen los permisos necesarios para ver la página solicitada.');
}

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionListar() {       
        $gestor = new GestorUsuarios;
        $searchModel = new UsuariosBuscar;
        $roles = $gestor->ListarRoles();
        $listDataU = ArrayHelper::map($roles,'IdRol','Rol');
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pNombre = $searchModel['Nombre'];
            $pApellido = $searchModel['Apellido'];
            $pEmail = $searchModel['Email'];
            $pIdRol = $searchModel['Rol'][0];
            $pEstado = $searchModel['Estado'];
            $usuarios = $gestor->Buscar($pNombre, $pApellido, $pEmail, $pIdRol, $pEstado);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $usuarios,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listData' => $listDataU]);
        }
        else{
            $usuarios = $gestor->Listar();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $usuarios,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'listData' => $listDataU]);
        }
    }
    
    
    public function actionAlta() {
        $model = new Usuarios;
        $model->scenario = 'alta-usuario';
        $gestoru = new GestorUsuarios;
        $gestorgt = new GestorGruposTrabajo;
        $grupostrabajo = $gestorgt->Listar();
        $listData= ArrayHelper::map($grupostrabajo,'IdGT','GrupoTrabajo');
        $roles = $gestoru->ListarRoles();
        $listDataU = ArrayHelper::map($roles,'IdRol','Rol');
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pIdGT = $model->IdGT;
            $pIdRol = $model->IdRol;
            $pNombre = $model->Nombre;
            $pApellido = $model->Apellido;
            $pEmail = $model->Email;
            $pPassword = Yii::$app->security->generatePasswordHash($model->Password);
            $pauth_key = $model->beforeGuardar();
            $mensaje = $gestoru->Alta($pIdGT, $pIdRol, $pNombre, $pApellido, $pEmail, $pPassword, $pauth_key);
            return $mensaje[0]['Mensaje'];
        }
        else{
            return $this->renderAjax('alta',['model' => $model, 'listData' => $listData, 'listDataU' => $listDataU]);
        }
    }
    
    public function actionModificar() {
        $model = new Usuarios;
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $usuario = $gestor->Dame($pIdUsuario);
        if($model->load(Yii::$app->request->post()) && ($model->validate()))
        {
            $pNombre = $model->Nombre;
            $pApellido = $model->Apellido;
            $pEmail = $model->Email;
            $mensaje = $gestor->Modificar($pIdUsuario, $pNombre, $pApellido, $pEmail);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/usuarios/listar');
            }
            else{
                return $mensaje[0]['Mensaje'];
            }
        }
        else{
           return $this->renderAjax('modificar',['model' => $model, 'usuario' => $usuario ]);
        }
    }
    
    public function actionBorrar() {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $mensaje = $gestor->Borrar($pIdUsuario);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/usuarios/listar');
    }

    public function actionBaja() {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $mensaje = $gestor->Baja($pIdUsuario);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/usuarios/listar');
        }
        else{
            return $mensaje[0]['Mensaje'];
        }
    }
    
    public function actionActivar()
    {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $mensaje = $gestor->Activar($pIdUsuario);
        Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
        return $this->redirect('/sgpoc/backend/web/usuarios/listar');
    }
    
    public function actionPerfil()
    {
        $model = new Usuarios;
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->user->identity['IdUsuario'];
        $usuario =  $gestor->Dame($pIdUsuario);
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pNombre = $model->Nombre;
            $pApellido = $model->Apellido;
            $pEmail = $model->Email;
            $pPassword = Yii::$app->security->generatePasswordHash($model->Password);
            $pauth_key = $model->beforeSave();
            $mensaje = $gestor->Modificar($pIdUsuario, $pNombre, $pApellido, $pEmail, $pPassword, $pauth_key);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/site/index');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->render('perfil',['model' => $model, 'usuario' => $usuario]);
            }
        }
        else{
            return $this->render('perfil', ['model' => $model, 'usuario' => $usuario]);
        }
    }

    public function actionExportar() {
        $gestor = new GestorUsuarios;
        $pIdGT = Yii::$app->user->identity['IdGT'];
        $usuarios = $gestor->Listar();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $usuarios,
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
                'SetHeader' => ['Usuarios||Generado el: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
     }
    
}
