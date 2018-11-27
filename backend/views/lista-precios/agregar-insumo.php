<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
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
        <h1 class="modal-title">Agregar Insumo</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'IdInsumo')->dropDownList($listDataI, ['prompt' => 'Seleccione uno ...' ])->label('Insumo');  ?>
            <?= $form->field($model, 'PrecioLista', ['addon' => ['prepend' => ['content'=>'$']]])->textInput(['placeholder'=>'Ingrese el Precio de Lista ...']) ?>
            <?= $form->field($model, 'FechaUltimaActualizacion')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inregese la Fecha del Presupuesto ...'],
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
        <div class="modal-footer">
            <?= html::submitButton('Agregar',['class'=>'btn btn-success pull-right']); ?>
            <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>
