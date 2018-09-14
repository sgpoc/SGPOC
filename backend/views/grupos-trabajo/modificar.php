<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
use yii\jui\AutoComplete;

?>

<?php if(Yii::$app->session->getFlash('alert')){
    echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => 'Cuidado!',
    'icon' => 'glyphicon glyphicon-remove-sign',
    'body' => Yii::$app->session->getFlash('alert'),
    'showSeparator' => true,
    'delay' => 1500,
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
        <h1 class="modal-title">Modificación</h1>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'GrupoTrabajo',['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$GrupoTrabajo[0]['GrupoTrabajo']]) ?>
            <?= $form->field($model, 'Mail', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$GrupoTrabajo[0]['Mail']]) ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
 

