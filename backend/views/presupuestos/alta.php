<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\widgets\Growl;
use kartik\date\DatePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\web\Controller;
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
            <?= $form->field($modellinea, 'IdLocalidad')->dropDownList($listDataL, ['prompt' => 'Seleccione uno ...' ])->label('Localidad');  ?>
            <?= $form->field($model, 'IdObra')->dropDownList($listDataO, ['id' => 'IdObra', 'prompt' => 'Seleccione uno ...' ])->label('Obra');  ?>
            <?= $form->field($model, 'IdComputoMetrico')->widget(DepDrop::className(), [
                'pluginOptions'=>[
                    'depends'=>['IdObra'],
                    'placeholder'=>'Selecccione uno ...',
                    'url'=>Url::to('/sgpoc/backend/web/obras/listar-computos'),
                ]])
                ->label('Cómputo Métrico');  
            ?>
            <?= $form->field($model, 'FechaDePresupuesto')->widget(DatePicker::classname(), [
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
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>