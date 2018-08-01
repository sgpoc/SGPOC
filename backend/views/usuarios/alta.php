<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */
// cambio.
$this->title = 'Usuarios';
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
    <h1>Alta Usuario</h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'IdGT')->dropDownList($listData, ['prompt' => 'Seleccione uno ...' ])->label('Grupo de Trabajo');  ?>
    <?= $form->field($model, 'IdRol')->dropDownList($listDataU, ['prompt' => 'Seleccione uno ...' ])->label('Rol');  ?>
    <?= $form->field($model, 'Nombre', ['addon' => ['prepend' => ['content'=>'N']]])->textInput(['placeholder'=>'Ingrese el nombre ...']) ?>
    <?= $form->field($model, 'Apellido', ['addon' => ['prepend' => ['content'=>'A']]])->textInput(['placeholder'=>'Ingrese el apellido ...']) ?>
    <?= $form->field($model, 'Email', ['addon' => ['prepend' => ['content'=>'@']]])->textInput(['placeholder'=>'Ingrese una dirección de Email válida ...']) ?>
    <?= $form->field($model, 'Password', ['addon' => ['prepend' => ['content'=>'<i class="fa fa-lock"></i>']]])->passwordInput(['placeholder'=>'Ingrese la contraseña ...']) ?>

    <?= html::submitButton('Alta',['class'=>'btn btn-success pull-left']); ?>
    <?= Html::a('<i class="fa fa-arrow-circle-left"></i> Volver', Yii::$app->request->referrer,['class'=>'btn btn-success pull-right']); ?>
    
<?php ActiveForm::end() ?>

</div>