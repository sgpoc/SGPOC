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
            <?= $form->field($model, 'Insumo', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['value'=>$insumo[0]['Insumo']]) ?>
            <?= $form->field($model, 'TipoInsumo', [
                'addon' => [
                    'prepend' => [
                        'content'=>'T'
                    ]
                 ],
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => [
                    'placement' => 'right', 
                    'onLabelClick' => true, 
                    'onLabelHover' => false
                ]
            ])
            ->textInput(['value'=>$insumo[0]['TipoInsumo']])
            ->hint('El Tipo de Insumo debe ser obligatoriamente M(refiriendose a Materiales) u O(refiriendose a Mano de Obra).');
            ?>
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