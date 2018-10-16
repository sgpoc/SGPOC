<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\widgets\Growl;
use kartik\date\DatePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\web\Controller;


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
            <?= $form->field($modellinea, 'IdProveedor')->dropDownList($listDataP, ['id' => 'IdProveedor', 'prompt' => 'Seleccione uno ...' ])->label('Proveedor Inicial');  ?>
            <?= $form->field($modellinea, 'IdLocalidad')->widget(DepDrop::className(), [
                'pluginOptions'=>[
                    'depends'=>['IdProveedor'],
                    'placeholder'=>'Selecccione uno ...',
                    'url'=>Url::to('/sgpoc/backend/web/proveedores/listar-localidades'),
                ]])
                ->label('Localidad Inicial');  
            ?>
            <?= $form->field($model, 'IdObra')->dropDownList($listDataO, ['id' => 'IdObra', 'prompt' => 'Seleccione uno ...' ])->label('Obra');  ?>
            <?= $form->field($model, 'IdComputoMetrico')->widget(DepDrop::className(), [
                'pluginOptions'=>[
                    'depends'=>['IdObra'],
                    'placeholder'=>'Selecccione uno ...',
                    'url'=>Url::to('/sgpoc/backend/web/obras/listar-computos'),
                ]])
                ->label('Cómputo Métrico');  
            ?>
            <?= $form->field($model, 'FechaDePresupuesto')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inregese la Fecha del Presupuesto ...'],
                    'pickerIcon' => '<i class="far fa-calendar-alt"></i>',
                    'pluginOptions'=>[
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]); 
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
