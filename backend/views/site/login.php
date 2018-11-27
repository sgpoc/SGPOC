<?php

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Growl;

LoginAsset::register($this);

$this->title = 'SGPOC | Login';

?>

<?php if(Yii::$app->session->getFlash('alert')){
    echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => 'Error!',
    'icon' => 'glyphicon glyphicon-remove-sign',
    'body' => Yii::$app->session->getFlash('alert'),
    'showSeparator' => true,
    'pluginOptions' => [
        'showProgressbar' => false,
        'placement' => [
            'from' => 'top',
            'align' => 'center',
        ]
    ]
    ]);
    }
?>

<body> 
       <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-50 p-l-15 p-r-15">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div style="text-align: center">
                    <img src="http://localhost/sgpoc/backend/web/img/logo-sgpoc.png" alt="Logo SGPOC">
                </div>
                <span class="login100-form-title p-t-20 p-b-45">
                    S G P O C
                </span>
                <div class="wrap-input100 m-b-10">
                    <?= $form->field($model, 'username')->textInput(['class' => 'input100', 'placeholder' => 'Ingrese Email', 'autocomplete' => 'off'])->label(false) ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user"></i>
                    </span>
                </div> 
                <div class="wrap-input100 m-b-10">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'input100', 'placeholder' => 'Ingrese contrasena', 'autocomplete' => 'off'])->label(false) ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn" type="submit" name="login-button">
                        Login
                    </button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>   
</body>
                                    
                                    