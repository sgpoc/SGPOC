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
                'id' =>'item-id',
                'data' => $listDataI,
                'options' => ['placeholder' => 'Seleccione un Item ...'],
                'pluginOptions' => [
                        'allowClear' => true
            ]])->label('Item');  ?>
            <?= $form->field($model, 'IdUnidad')->dropDownList($listDataU, ['id' => 'unidad','prompt' => 'Seleccione uno ...'])->label('Unidad');  ?>
            </div>
            <?= $form->field($model, 'Cantidad', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder' => 'Ingrese la cantidad ...']); ?>
            <?= $form->field($model, 'Largo', ['addon' => ['prepend' => ['content'=>'L']]])->textInput(['placeholder'=>'Ingrese el largo ...']) ?>
            <?= $form->field($model, 'Ancho', ['addon' => ['prepend' => ['content'=>'An']]])->textInput(['placeholder'=>'Ingrese el ancho ...']) ?>
            <div id="alto">
            <?= $form->field($model, 'Alto', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['id' => 'alto',
                'placeholder'=>'Ingrese el alto ...']) ?>
            </div>
            <?= $form->field($model, 'Descripcion')->textArea(['rows'=>5]) ?> 
                  
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

<?php 
$script = <<< JS

$(document).ready(function(){     $("#alto").hide();
$('#unidad').on('change', function() {
  if ( $(event.target).val() == 9)
  {
    $("#alto").show();
  }
  else{
      $("#alto").hide();
  }        
}); 
});

JS;
$this->registerJS($script);
?>