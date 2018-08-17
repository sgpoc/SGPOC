<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SGPOC | Login';
LoginAsset::register($this);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= Html::encode($this->title) ?></title>
    </head>
<body>
    <div class="title"><h1>Sign In Form</h1></div>
        <div class="container">
            <div class="left"></div>
            <div class="right">
                <div class="form-box">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, 'username', ['options' => ['tag' => 'div','class' => 'form-group field-loginform-username has-feedback required',]])->textInput(['placeholder' => 'Ingrese Email']) ?>
                        <?= $form->field($model, 'password', ['options' => ['tag' => 'div','class' => 'form-group field-loginform-password has-feedback required',]])->passwordInput(['placeholder' => 'Ingrese la Contraseña']) ?>
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</body>
</html>

