<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
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
            <?= $form->field($model, 'IdProveedor')->dropDownList($listDataP, ['prompt' => 'Seleccione uno ...' ])->label('Proveedor');  ?>
            <?= $form->field($model, 'IdLocalidad')->dropDownList($listDataL, ['prompt' => 'Seleccione uno ...' ])->label('Localidad');  ?>
            <?= $form->field($model, 'IdInsumo')->dropDownList($listDataI, ['prompt' => 'Seleccione uno ...' ])->label('Insumo');  ?>
            <?= $form->field($model, 'PrecioLista', ['addon' => ['prepend' => ['content'=>'$']]])->textInput(['placeholder'=>'Ingrese el Precio de Lista ...']) ?>
            <?= $form->field($model, 'FechaUltimaActualizacion')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inregese la fecha de ultima actualizacion ...'],
                    'pickerIcon' => '<i class="far fa-calendar-alt"></i>',
                    'pluginOptions'=>[
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]); 
            ?>
        </div>
        <div class="modal-footer">
            <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
            <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
