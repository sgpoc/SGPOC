<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SGPOC | Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->title?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transmition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="">
                <img src="https://pixel.nymag.com/imgs/custom/tvrecaps/recaps-south-park-160x160.png" class="user-image" alt='mario'>
            </a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Logueese para iniciar sesión</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-username has-feedback required',
                    ],
                    'template' => '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span> 
                                       {error}{hint}'
                ])->textInput(['placeholder' => 'Ingrese Email']) ?>
                <?= $form->field($model, 'password', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-password has-feedback required'
                    ],
                    'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> 
                                       {error}{hint}'
                ])->passwordInput(['placeholder' => 'Ingrese la Contraseña']) ?>
                <div align="center">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div align="center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</body>
</html>
