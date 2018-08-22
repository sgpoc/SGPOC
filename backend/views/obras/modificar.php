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
        <h1 class="modal-title">Modificación</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Obra', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre ...'])->label('Nombre'); ?>
            <?= $form->field($model, 'Direccion', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['placeholder'=>'Ingrese la dirección ...']) ?>
            <?= $form->field($model, 'Propietario', ['addon' => ['prepend' => ['content'=>'P']]])->textInput(['placeholder'=>'Ingrese el propietario ...']) ?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-phone"></i>']]])->textInput(['placeholder'=>'Ingrese el teléfono del propietario ...']) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->input(['autocomplete'=>'off'])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']) ?>
            <?= $form->field($model, 'Comentarios')->textInput(['style'=>'height:100px']) ?>
            <?= $form->field($model, 'SuperficieTerreno', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder'=>'Ingrese la superficie del terreno ...']) ?>
            <?= $form->field($model, 'SuperficieCubiertaTotal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['placeholder'=>'Ingrese la superficie cubierta total ...']) ?>
        </div>
        <div class="modal-footer">
            <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
        </div>
    </div>
</div>    
<?php ActiveForm::end() ?>