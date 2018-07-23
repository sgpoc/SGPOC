<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Familias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1>Modificación Familia</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Familia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>