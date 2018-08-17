<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */
// cambio.

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
            <?= $form->field($model, 'IdSubFamilia')->dropDownList($listData, ['prompt' => 'Seleccione uno ...' ])->label('SubFamilia');  ?>
            <?= $form->field($model, 'IdUnidad')->dropDownList($listDataU, ['prompt' => 'Seleccione uno ...' ])->label('Unidad');  ?>
            <?= $form->field($model, 'Insumo', ['addon' => ['prepend' => ['content'=>'I']]])->textInput(['placeholder'=>'Ingrese el nombre ...']) ?>
            <?= $form->field($model, 'TipoInsumo', ['addon' => ['prepend' => ['content'=>'TI']]])->textInput(['placeholder'=>'Ingrese el tipo ...']) ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
