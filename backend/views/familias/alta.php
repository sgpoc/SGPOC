<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Growl;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;

GrowlAsset::register($this);
AnimateAsset::register($this);
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


<?php $form = ActiveForm::begin(['id'=>'formModal']); ?>
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title">Alta</h1>   
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'Familia', ['addon' => ['prepend' => ['content'=>'F']]])->textInput(['placeholder'=>'Ingrese el nombre ...'])->label('Nombre') ?>   
        </div>
    </div>
    <div class="modal-footer">
        <?= html::submitButton('Alta',['class'=>'btn btn-success pull-right']); ?>
        <?= html::button('Cerrar',['class'=>'btn btn-default pull-right', 'data-dismiss'=>'modal']); ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php $script = <<< JS

$("form#formModal").on("beforeSubmit", function(e) {
  var form = $(this);
  $.post(
    form.attr("action"), //serialize yii2 form
    form.serialize() //pone los datos del form en un array
  )
    .done(function(result) {
      if (result === "OK.") {
        form.trigger("reset");
        $.pjax.reload({ container: "#gridview" });
        $.notify(
          {
            icon: "glyphicon glyphicon-ok-sign",
            message: result
          },
          {
            type: "success",
            delay: 1500,
            z_index: 2000,
            placement: { from: "top", align: "center" }
          }
        );
      } else {
        $.notify(
          {
            icon: "glyphicon glyphicon-remove-sign",
            message: result
          },
          {
            type: "danger",
            delay: 1500,
            z_index: 2000,
            placement: { from: "top", align: "center" }
          }
        );
      }
    })
    .fail(function() {
      console.log("server error");
    });
  return false;
});

JS;
$this->registerJS($script);
