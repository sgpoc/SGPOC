<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1>Alta Familia</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Familia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-primary pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>