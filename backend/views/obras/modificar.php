<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use backend\assets\AppAsset;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;

AppAsset::register($this);
GrowlAsset::register($this);
AnimateAsset::register($this);

?>


<?php $form = ActiveForm::begin(['id' => 'formModal']); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Modificación</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Obra', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['value'=>$obra[0]['Obra']])  ?>
            <?= $form->field($model, 'Direccion', ['addon' => ['prepend' => ['content'=>'D']]])->textInput(['value'=>$obra[0]['Direccion']]) ?>
            <?= $form->field($model, 'Propietario', ['addon' => ['prepend' => ['content'=>'P']]])->textInput(['value'=>$obra[0]['Propietario']]) ?>
            <?= $form->field($model, 'Telefono', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-mobile-alt"></i>']]])->textInput(['value'=>$obra[0]['Telefono']]) ?>
            <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->input(['autocomplete'=>'off'])->textInput(['value'=>$obra[0]['Email']]) ?>
            <?= $form->field($model, 'Comentarios')->textArea(['row'=>5, 'value'=>$obra[0]['Comentarios']]) ?>
            <?= $form->field($model, 'SuperficieTerreno', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['value'=>$obra[0]['SuperficieTerreno']]) ?>
            <?= $form->field($model, 'SuperficieCubiertaTotal', ['addon' => ['prepend' => ['content'=>'#']]])->textInput(['value'=>$obra[0]['SuperficieCubiertaTotal']]) ?>
        </div>
        <div class="modal-footer">
            <?= html::submitButton('Modificar',['class'=>'btn btn-success pull-right']); ?>
            <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
        </div>
    </div>
</div>    
<?php ActiveForm::end() ?>

<?php
$this->registerJs("VistaModal.init();");
?>
