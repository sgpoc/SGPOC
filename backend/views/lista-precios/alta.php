<?php

use yii\helpers\Html;
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
        <h1 class="modal-title">Alta</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'IdProveedor')->dropDownList($listDataP, ['prompt' => 'Seleccione uno ...' ])->label('Proveedor');  ?>
            <?= $form->field($model, 'IdLocalidad')->dropDownList($listDataL, ['prompt' => 'Seleccione uno ...' ])->label('Localidad');  ?>
            <?= $form->field($model, 'IdInsumo')->dropDownList($listDataI, ['prompt' => 'Seleccione uno ...' ])->label('Insumo');  ?>
            <?= $form->field($model, 'PrecioLista', ['addon' => ['prepend' => ['content'=>'$']]])->textInput(['placeholder'=>'Ingrese el Precio de Lista ...']) ?>
            <?= $form->field($model, 'FechaUltimaActualizacion')->widget(DatePicker::classname(), [
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
        <div class="modal-footer">
            <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
            <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>