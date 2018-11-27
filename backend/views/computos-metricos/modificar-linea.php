<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
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
        <h1 class="modal-title">Modificar Línea</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Cantidad', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['value'=>$lineacomputo[0]['Cantidad']]) ?>
            <?= $form->field($model, 'Largo', ['addon' => ['prepend' => ['content'=>'L']]])->textInput(['value'=>$lineacomputo[0]['Largo']]) ?>
            <?= $form->field($model, 'Ancho', ['addon' => ['prepend' => ['content'=>'An']]])->textInput(['value'=>$lineacomputo[0]['Ancho']]) ?>
            <?= $form->field($model, 'Alto', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['value'=>$lineacomputo[0]['Alto']]) ?>
            <?= $form->field($model, 'Descripcion')->textArea(['rows'=>5, 'value'=>$lineacomputo[0]['Descripcion']]) ?>
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