<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\widgets\Growl;
use kartik\date\DatePicker;

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
            <?= $form->field($model, 'Descripcion')->textArea(['row'=>5]) ?>
            <?= $form->field($model, 'FechaComputoMetrico')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inregese la Fecha del Computo Metrico ...'],
                    'pickerIcon' => '<i class="far fa-calendar-alt"></i>',
                    'convertFormat' => true,
                    'pluginOptions'=>[
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true,
                        'format' => 'yyyy-M-d'
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
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
