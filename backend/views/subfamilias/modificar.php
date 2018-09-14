<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
            <?= $form->field($model, 'SubFamilia', ['addon' => ['prepend' => ['content'=>'SF']]])->textInput(['value'=>$subfamilia[0]['SubFamilia']]) ?>   
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>