<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
use kartik\widgets\Select2;
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
        <h1 class="modal-title">Agregar Item</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'IdItem')->widget(Select2::classname(), [
                'data' => $listDataI,
                'options' => ['placeholder' => 'Seleccione un Item ...'],
                'pluginOptions' => [
                        'allowClear' => true
            ]])->label('Item');  ?>
            <?= $form->field($model, 'Incidencia', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['placeholder'=>'Ingrese la incidencia del Item en el Elemento ...']) ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Agregar',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>
