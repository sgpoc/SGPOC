<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
use backend\assets\AppAsset;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;

AppAsset::register($this);
GrowlAsset::register($this);
AnimateAsset::register($this);

?>

<?php $form = ActiveForm::begin(['id' => 'formModal']); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Modificar Porcentajes</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Beneficios', ['addon' => ['prepend' => ['content'=>'B']]])->textInput(['value'=>$lineapresupuesto[0]['Beneficios']]) ?>
            <?= $form->field($model, 'GastosGenerales', ['addon' => ['prepend' => ['content'=>'GG']]])->textInput(['value'=>$lineapresupuesto[0]['GastosGenerales']]) ?>
            <?= $form->field($model, 'CargasSociales', ['addon' => ['prepend' => ['content'=>'CS']]])->textInput(['value'=>$lineapresupuesto[0]['CargasSociales']]) ?>
            <?= $form->field($model, 'IVA', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['value'=>$lineapresupuesto[0]['IVA']]) ?>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>