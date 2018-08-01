<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos Trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(Yii::$app->session->getFlash('alert')){
    echo Alert::widget([
        'type' => Alert::TYPE_DANGER,
        'title' => 'Cuidado!',
        'icon' => 'glyphicon glyphicon-info-sign',
        'body' => Yii::$app->session->getFlash('alert'),
        'showSeparator' => true,
        'delay' => 8000
    ]);
    }
?>
 


<div>
    <h1>Alta Grupo de Trabajo</h1>
    <?php $form = ActiveForm::begin(); ?>
      
    <?= $form->field($model, 'GrupoTrabajo',['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre ...'])->label('Nombre') ?>
    <?= $form->field($model, 'Mail', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']); ?>


    <?= html::submitButton('Alta',['class'=>'btn btn-success pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-success pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>