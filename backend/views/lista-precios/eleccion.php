<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */
// cambio.

$this->title = 'SGPOC | Lista de Precios';


?>

<?php $form = ActiveForm::begin(); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Seleccionar</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'IdProveedor')->dropDownList($listDataP, ['prompt' => 'Seleccione uno ...' ])->label('Proveedor');  ?>
            <?= $form->field($model, 'IdLocalidad')->dropDownList($listDataL, ['prompt' => 'Seleccione uno ...' ])->label('Localidad');  ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Elegir',['class'=>'btn btn-success pull-right']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>



