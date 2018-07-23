<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div>
    <h1>Búsqueda Grupo de Trabajo</h1>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pCadena')->textInput()->label('Nombre')->hint('Ingrese el nombre del Grupo de Trabajo a buscar') ?>
        <?= $form->field($model, 'pIncluyeBajas')->textInput()->label('Inclusion de bajas')->hint('Debe especificar si incluye bajas. S: Si, N: No') ?>    
    
        <?= html::submitButton('Buscar',['class'=>'btn btn-primary pull-left']); ?>
        <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>

    <?php ActiveForm::end() ?>
</div>


