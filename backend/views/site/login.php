<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>SGPOC</b></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Logueese para iniciar sesión</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'username', [
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form-group field-loginform-username has-feedback required'
                            ],
                        'template' => '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span> 
                                       {error}{hint}'
                    ])->textInput(['placeholder']) ?>
                    <?= $form->field($model, 'password', [
                        'options' => [
                            'tag' => 'div',
                            'class' => 'form-group field-loginform-password has-feedback required'
                            ],
                        'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> 
                                       {error}{hint}'
                    ])->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                    <p class="text-center"> OR </p>
                    <?= Html::submitButton('Sign in using Google+', ['class' => 'btn btn-block btn-social btn-google btn-flat','name' => 'google-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> 
