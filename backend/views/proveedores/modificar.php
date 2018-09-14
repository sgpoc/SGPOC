<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\password\PasswordInput;
use yii\jui\AutoComplete;


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
        <h1 class="modal-title">Modificación</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Proveedor', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$proveedor[0]['Proveedor']]) ?>
            <?= $form->field($model, 'Domicilio', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['value'=>$proveedor[0]['Domicilio']]) ?>
            <?= $form->field($model, 'CodigoPostal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['value'=>$proveedor[0]['CodigoPostal']]) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$proveedor[0]['Email']])?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-phone"></i>']]])->textInput(['value'=>$proveedor[0]['Telefono']]) ?>
            <?= $form->field($model, 'PaginaWEB', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-globe"></i>']]])->textInput(['value'=>$proveedor[0]['PaginaWEB']]) ?>  
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>