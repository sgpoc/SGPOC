<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubFamiliaBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Tipos de Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Yii::$app->session->getFlash('alert'); ?>
<div>
    <h1>Alta Tipo de Insumo</h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'IdFamilia')->dropDownList($listData, ['prompt' => 'Seleccione Uno' ])->label('Familias');  ?>
    <?= $form->field($model, 'SubFamilia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>