<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;

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
        <h1 class="modal-title">Modificar Porcentajes</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Beneficios', ['addon' => ['prepend' => ['content'=>'B']]])->textInput(['value'=>$lineapresupuesto[0]['Beneficios']]) ?>
            <?= $form->field($model, 'GastosGenerales', ['addon' => ['prepend' => ['content'=>'GG']]])->textInput(['value'=>$lineapresupuesto[0]['GastosGenerales']]) ?>
            <?= $form->field($model, 'CargasSociales', ['addon' => ['prepend' => ['content'=>'CS']]])->textInput(['value'=>$lineapresupuesto[0]['CargasSociales']]) ?>
            <?= $form->field($model, 'IVA', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['value'=>$lineapresupuesto[0]['IVA']]) ?>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>