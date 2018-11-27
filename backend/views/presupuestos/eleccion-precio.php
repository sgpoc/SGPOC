<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\widgets\Growl;
use kartik\daterange\DateRangePicker;
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
        <h1 class="modal-title">Elección Lista de Precios</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($modellinea, 'IdProveedor')->dropDownList($listDataP, ['id' => 'IdProveedor', 'prompt' => 'Seleccione uno ...' ])->label('Proveedor');  ?>
            <?= $form->field($modellinea, 'IdLocalidad')->widget(DepDrop::className(), [
                'pluginOptions'=>[
                    'depends'=>['IdProveedor'],
                    'placeholder'=>'Selecccione uno ...',
                    'url'=>Url::to('/sgpoc/backend/web/proveedores/listar-localidades'),
                ]])
                ->label('Localidad');  
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Elegir',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>