<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
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
            <?= $form->field($model, 'IdLocalidad')->dropDownList($listData, ['prompt' => 'Seleccione uno ...' ])->label('Localidad');  ?>
            <?= $form->field($model, 'Obra', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre de la Obra ...'])->label('Nombre Obra'); ?>
            <?= $form->field($model, 'Direccion', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['placeholder'=>'Ingrese la dirección ...']) ?>
            <?= $form->field($model, 'Propietario', ['addon' => ['prepend' => ['content'=>'P']]])->textInput(['placeholder'=>'Ingrese el propietario ...']) ?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-alt"></i>']]])->textInput(['placeholder'=>'Ingrese el teléfono del propietario ...']) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->input(['autocomplete'=>'off'])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']) ?>
            <?= $form->field($model, 'Comentarios')->textArea(['row'=>5]) ?>
            <?= $form->field($model, 'SuperficieTerreno', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder'=>'Ingrese la superficie del terreno ...']) ?>
            <?= $form->field($model, 'SuperficieCubiertaTotal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder'=>'Ingrese la superficie cubierta total ...']) ?>
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
