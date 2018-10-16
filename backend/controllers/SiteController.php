<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\Usuarios;
use app\models\GestorUsuarios;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'], 
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login','logout'],
                        'roles' => ['@'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/sgpoc/backend/web/site/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogout()
    {
        $this->layout = 'index';
        Yii::$app->user->logout();
        return $this->redirect('/sgpoc/backend/web/site/login');
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
}
