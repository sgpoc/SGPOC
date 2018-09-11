<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\widgets\Growl;
use kartik\daterange\DateRangePicker;

?>

<?php if(Yii::$app->session->getFlash('alert')){
        echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => 'Cuidado!',
        'icon' => 'glyphicon glyphicon-remove-sign',
        'body' => Yii::$app->session->getFlash('alert'),
        'showSeparator' => true,
        'delay' => 1000,
        'pluginOptions' => [
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'center',
            ]
        ]
        ]);
    }
?>  

<?php $form = ActiveForm::begin(); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Alta</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'IdObra')->dropDownList($listDataO, ['prompt' => 'Seleccione uno ...' ])->label('Obra');  ?>
            <?= $form->field($model, 'FechaComputoMetrico', [
                    'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
                    'options'=>['class'=>'drp-container form-group']
                ])->widget(DateRangePicker::classname(), [
                    'useWithAddon'=>true,
                    'pluginOptions'=>[
                        'singleDatePicker'=>true,
                        'showDropdowns'=>true
                    ]
                ]); 
            ?>            
            <?= $form->field($model, 'TipoComputo', [
                'addon' => [
                    'prepend' => ['content'=>'T']
                ],
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => [
                    'placement' => 'right', 
                    'onLabelClick' => true, 
                    'onLabelHover' => false
                ]])
                ->textInput(['placeholder'=>'Ingrese el Tipo ...'])
                ->hint('El Tipo de Cómputo Métrico debe ser obligatoriamente I (refiriendose a Items) o E(refiriendose a Elementos Constructivos).'); 
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
