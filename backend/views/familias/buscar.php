<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pCadena')->textInput()->label('Nombre')->hint('Ingrese el nombre de la familia que desea buscar') ?>    
    
    <?= html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>



