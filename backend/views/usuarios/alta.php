<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */
// cambio.
$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'IdGT')->dropDownList($listData, ['prompt' => 'Seleccione Uno' ])->label('Grupo de Trabajo');  ?>
    <?= $form->field($model, 'Nombre')->textInput() ?>
    <?= $form->field($model, 'Apellido')->textInput() ?>
    <?= $form->field($model, 'Rol')->textInput() ?>
    <?= $form->field($model, 'Email')->input('email') ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary']); ?>
    
<?php ActiveForm::end() ?>

</div>