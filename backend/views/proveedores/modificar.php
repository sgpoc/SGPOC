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
        <h1 class="modal-title">Modificación</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Proveedor', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$proveedor[0]['Proveedor']]) ?>
            <?= $form->field($model, 'Domicilio', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['value'=>$proveedor[0]['Domicilio']]) ?>
            <?= $form->field($model, 'CodigoPostal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['value'=>$proveedor[0]['CodigoPostal']]) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$proveedor[0]['Email']])?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-alt"></i>']]])->textInput(['value'=>$proveedor[0]['Telefono']]) ?>
            <?= $form->field($model, 'PaginaWEB', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-globe-americas"></i>']]])->textInput(['value'=>$proveedor[0]['PaginaWEB']]) ?>  
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>