<?php

use yii\helpers\Html;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SGPOC | Familias';

$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'header' => '#',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Familia',
        'label' => 'Nombre',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {listarsubfamilias}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/familias/modificar', 'IdFamilia' => $model['IdFamilia']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Familia'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i>',
                            ['borrar','IdFamilia' => $model['IdFamilia']], 
                            [
                                'title' => 'Borrar Familia', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar la Familia?',
                                    'method' => 'post'
                                ]
                            ]);
                },
                'listarsubfamilias' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-th"></i>',
                            ['listar-subfamilias','IdFamilia' => $model['IdFamilia']], 
                            [
                                'title' => 'Lista Subfamilias Familia',
                                'class' => 'btn btn-link'
                            ]);
                },    
        ]
    ], 
] 

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

<?php
    Modal::begin([
            'header'=>'<h2>Familias</h2>',
            'footer'=>'',
            'id'=>'modal',
            'size'=>'modal-lg',
       ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>
        
<div>
    <?= GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'exportConfig' => [
                GridView::EXCEL => ['label' => 'Descargar como EXCEL'],
                GridView::TEXT => ['label' => 'Descargar como TEXTO'],
                GridView::PDF => ['label' => 'Descargar como PDF'],
         ],
        'toolbar' => [
            [
                'content' =>Html::button('<i class="glyphicon glyphicon-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/familias/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Familia'
                            ]).' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', 
                            ['familias/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-list"></i> Familias</h3>',
            'type' => GridView::TYPE_DEFAULT,
        ],
    ]);   
    ?>
</div>

    