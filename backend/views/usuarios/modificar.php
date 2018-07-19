<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Nombre')->textInput() ?>
    <?= $form->field($model, 'Apellido')->textInput() ?>
    <?= $form->field($model, 'Rol')->textInput() ?>
    <?= $form->field($model, 'Email')->input('email') ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary']); ?>
    
<?php ActiveForm::end() ?>

</div>