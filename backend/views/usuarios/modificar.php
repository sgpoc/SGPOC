<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1>Modificación Usuario</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Nombre')->textInput() ?>
    <?= $form->field($model, 'Apellido')->textInput() ?>
    <?= $form->field($model, 'Email')->input('email') ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>

    <?= html::submitButton('Modificar',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>