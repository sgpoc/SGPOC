<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pCadena')->textInput()->label('Nombre')->hint('Ingrese el apellido del Usuario a buscar') ?>
    <?= $form->field($model, 'pIncluyeBajas')->textInput()->label('Inclusion de bajas')->hint('Debe especificar si incluye bajas. S: Si, N: No') ?>    
    
    <?= html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>



