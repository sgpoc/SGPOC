<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use backend\assets\AppAsset;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;
use kartik\date\DatePicker;


AppAsset::register($this);
GrowlAsset::register($this);
AnimateAsset::register($this);

?>
 

<?php $form = ActiveForm::begin(['id' => 'formModal']); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Alta</h1>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'GrupoTrabajo',['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre ...'])->label('Nombre') ?>
            <?= $form->field($model, 'Mail', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']); ?>
            <?= $form->field($model, 'FechaCreacion')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inregese la fecha de ultima actualizacion ...'],
                    'pickerIcon' => '<i class="far fa-calendar-alt"></i>',
                    'convertFormat' => true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-M-d',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]); 
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>

