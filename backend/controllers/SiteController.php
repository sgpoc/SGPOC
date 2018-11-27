<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Usuarios;
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
    
}
