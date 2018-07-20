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
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'Familia')->textInput()->label('Nombre') ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-primary']); ?>
    
<?php ActiveForm::end() ?>

</div>