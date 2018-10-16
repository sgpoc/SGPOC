<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\password\PasswordInput;
use yii\jui\AutoComplete;

$this->title = 'SGPOC | Perfil' ;

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
        <h1 class="modal-title">Perfil</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Nombre', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$usuario[0]['Nombre']]) ?>
            <?= $form->field($model, 'Apellido', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['value'=>$usuario[0]['Apellido']]) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['value'=>$usuario[0]['Email']]) ?>
            <?= $form->field($model, 'Password', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-lock"></i>']]])->widget(PasswordInput::classname())?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Guardar Cambios',['class'=>'btn btn-success pull-right']); ?>
        <?= html::a('Volver',Yii::$app->request->referrer, ['class'=>'btn btn-default pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>