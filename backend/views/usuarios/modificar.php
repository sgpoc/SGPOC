<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\password\PasswordInput;
use yii\jui\AutoComplete;
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
            <?= $form->field($model, 'Nombre', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$usuario[0]['Nombre']]) ?>
            <?= $form->field($model, 'Apellido', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['value'=>$usuario[0]['Apellido']]) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$usuario[0]['Email']]) ?>
            <?= $form->field($model, 'Password', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-lock"></i>']]])->widget(PasswordInput::classname())?>
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