<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div>
    <h1>Búsqueda Familia</h1>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pCadena')->textInput()->label('Nombre')->hint('Ingrese el nombre de la familia que desea buscar') ?>    
    
    <?= html::submitButton('Buscar',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>

<?php ActiveForm::end() ?>
</div>


