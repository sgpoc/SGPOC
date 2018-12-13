<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\password\PasswordInput;
use kartik\widgets\Growl;
use kartik\form\ActiveField;


$this->title = 'SGPOC | Perfil';

?>

<?php if(Yii::$app->session->getFlash('alert')){
            if(substr(Yii::$app->session->getFlash('alert'), 0, 2) != 'OK') {
                echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'icon' => 'glyphicon glyphicon-remove-sign',
                'body' => Yii::$app->session->getFlash('alert'),
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
            else {
                echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('alert'),
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
            <?= $form->field($model, 'Password', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-lock"></i>']],
            'hintType' => ActiveField::HINT_SPECIAL,
            'hintSettings' => [
                'placement' => 'right', 
                'onLabelClick' => true, 
                'onLabelHover' => false
            ]])->passwordInput()
            ->hint('La contraseña puede omitirse, si se omite no se modificar la misma');?>
            
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Guardar Cambios',['class'=>'btn btn-success pull-right']); ?>
        <?= html::a('Cerrar',Yii::$app->request->referrer, ['class'=>'btn btn-default pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
