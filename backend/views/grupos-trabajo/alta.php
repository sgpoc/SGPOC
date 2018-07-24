<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos Trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Yii::$app->session->getFlash('alert'); ?>
<div>
    <h1>Alta Grupo de Trabajo</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'GrupoTrabajo')->textInput()->label('Nombre') ?>
    <?= $form->field($model, 'Mail')->input('email') ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>