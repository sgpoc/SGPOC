<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
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
            <?= $form->field($model, 'IdSubFamilia')->dropDownList($listData, ['prompt' => 'Seleccione uno ...' ])->label('SubFamilia');  ?>
            <?= $form->field($model, 'IdUnidad')->dropDownList($listDataU, ['prompt' => 'Seleccione uno ...' ])->label('Unidad');  ?>
            <?= $form->field($model, 'Insumo', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['placeholder'=>'Ingrese el nombre ...']) ?>
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
            ->textInput(['placeholder'=>'Ingrese el tipo ...'])
            ->hint('El Tipo de Insumo debe ser obligatoriamente M(refiriendose a Materiales) u O(refiriendose a Mano de Obra).');
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
