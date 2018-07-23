<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Grupos Trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1> Modificación Grupo de Trabajo </h1>
    <?php $form = ActiveForm::begin(); ?>
      
        <?= $form->field($model, 'GrupoTrabajo')->textInput()->label('Nombre') ?>
        <?= $form->field($model, 'Mail')->input('email') ?>
    
        <?= html::submitButton('Modificar',['class'=>'btn btn-primary pull-left']); ?>
        <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>    
    <?php ActiveForm::end() ?>

</div>