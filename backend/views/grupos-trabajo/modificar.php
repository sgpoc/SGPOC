<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Grupos Trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'GrupoTrabajo')->textInput()->label('Nombre') ?>
    <?= $form->field($model, 'Mail')->input('email') ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary']); ?>
    
<?php ActiveForm::end() ?>

</div>