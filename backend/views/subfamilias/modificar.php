<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Tipos de Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Yii::$app->session->getFlash('alert'); ?>
<div>
    <h1>Modificación Familia</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'SubFamilia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>