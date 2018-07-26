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
<?= Yii::$app->session->getFlash('alert'); ?>
<div>
    <h1>Alta Usuario</h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'IdGT')->dropDownList($listData, ['prompt' => 'Seleccione Uno' ])->label('Grupo de Trabajo');  ?>
    <?= $form->field($model, 'IdRol')->dropDownList($listDataU, ['prompt' => 'Seleccione Uno' ])->label('Rol');  ?>
    <?= $form->field($model, 'Nombre')->textInput() ?>
    <?= $form->field($model, 'Apellido')->textInput() ?>
    <?= $form->field($model, 'Email')->input('email') ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>