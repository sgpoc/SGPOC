<?php

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SGPOC | Login';
LoginAsset::register($this);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form Template</title>
</head>
<body>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                        	<h3>Login a SGPOC</h3>
                            	<p>Ingrese su Email y Contraseña:</p>
                            </div>
                            <div class="form-top-right">
                        	<i class="fa fa-lock"></i>
                            </div>
                        </div>
                            <div class="form-bottom">
                                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                    <?= $form->field($model, 'username', ['options' => ['tag' => 'div','class' => 'form-group field-loginform-username has-feedback required',]])->textInput(['placeholder' => 'Ingrese Email']) ?>
                                    <?= $form->field($model, 'password', ['options' => ['tag' => 'div','class' => 'form-group field-loginform-password has-feedback required',]])->passwordInput(['placeholder' => 'Ingrese la Contraseña']) ?>
                                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                                    <?php ActiveForm::end(); ?>
		            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
