<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
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
        <h1 class="modal-title">Modificación</h1>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'GrupoTrabajo',['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$grupotrabajo[0]['GrupoTrabajo']]) ?>
            <?= $form->field($model, 'Mail', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$grupotrabajo[0]['Mail']]) ?>
            <?= $form->field($model, 'FechaCreacion')->widget(DatePicker::classname(), [
                    'options' => ['value' => $grupotrabajo[0]['FechaCreacion']],
                    'pickerIcon' => '<i class="far fa-calendar-alt"></i>',
                    'convertFormat' => true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-M-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]); 
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
 
<?php
$this->registerJs("VistaModal.init();");
?>

