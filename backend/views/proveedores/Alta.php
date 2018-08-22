<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedoresBuscar */
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
            <?= $form->field($model, 'Proveedor', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre del proveedor ...']) ?>
            <?= $form->field($model, 'Domicilio', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['placeholder'=>'Ingrese el Domicilio ...']) ?>
            <?= $form->field($model, 'CodigoPostal', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['placeholder'=>'Ingrese el COdigo Postal ...']) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->input(['autocomplete'=>'off'])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']) ?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['placeholder'=>'Ingrese el Telefono ...']) ?>
            <?= $form->field($model, 'PaginaWEB', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['placeholder'=>'Ingrese la pagina web ...']) ?>
            
            
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
