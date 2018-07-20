<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Familias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Familia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary']); ?>
    
<?php ActiveForm::end() ?>

</div>