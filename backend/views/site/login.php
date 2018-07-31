<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SGPOC | Login';
$this->params['breadcrumbs'][] = $this->title;
LoginAsset::register($this);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->title?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="">
                <img src="https://www.suny.edu/media/suny/content-assets/brand-guidelines/SUNY-circle-tm-160x160.jpg" class="img-circle" alt='mario'>
            </a>
        </div>
        <div class="login-box-body">
            <h1 class="login-box-msg" align="center">Login</h1>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-username has-feedback required',
                    ],
                    'template' => '{input}<span class="fa fa-user form-control-feedback"></span>
                                       {error}{hint}'
                ])->textInput(['placeholder' => 'Ingrese Email']) ?>
                <?= $form->field($model, 'password', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-password has-feedback required',
                    ],
                    'template' => '{input}<span class="fa fa-lock form-control-feedback"></span> 
                                       {error}{hint}'
                ])->passwordInput(['placeholder' => 'Ingrese la Contraseña']) ?>
                <div align="center">
                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</body>
</html>
