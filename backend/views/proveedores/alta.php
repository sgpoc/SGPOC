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
            <?= $form->field($model, 'Proveedor', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre del proveedor ...']) ?>
            <?= $form->field($model, 'Domicilio', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['placeholder'=>'Ingrese el Domicilio ...']) ?>
            <?= $form->field($model, 'CodigoPostal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder'=>'Ingrese el Código Postal ...']) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->input(['autocomplete'=>'off'])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']) ?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-alt"></i>']]])->textInput(['placeholder'=>'Ingrese el Telefono ...']) ?>
            <?= $form->field($model, 'PaginaWEB', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-globe-americas"></i>']]])->textInput(['placeholder'=>'Ingrese la pagina web ...']) ?>
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