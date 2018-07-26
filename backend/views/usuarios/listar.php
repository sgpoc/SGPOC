<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;


$colorPluginOptions =  [
    'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => false,
    'preferredFormat' => 'name',
    'palette' => [
        [
            "white", "black", "grey", "silver", "gold", "brown", 
        ],
        [
            "red", "orange", "yellow", "indigo", "maroon", "pink"
        ],
        [
            "blue", "green", "violet", "cyan", "magenta", "purple", 
        ],
    ]
];

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
        'attribute' => 'Nombre',
        'vAlign' => 'middle',
        /*'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(), 
            'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
            'options' => ['multiple' => true]
            ],*/
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Apellido',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Email',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Rol',
        'label' => 'Rol',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Estado',
        //'trueLabel' => 'Activo', 
        //'falseLabel' => 'Inactivo',
        'vAlign' => 'middle',
        'hAlign' => 'center'
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {baja} {activar}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['modificar','IdUsuario' => $model['IdUsuario']], ['title' => 'Modificar Usuario.', 'class' => 'btn btn-link']);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['borrar','IdUsuario' => $model['IdUsuario']], ['title' => 'Borra Usuario.', 'class' => 'btn btn-link',
                        'data' => [
                            'confirm' => 'Esta seguro que desea borrar el Usuario?',
                            'method' => 'post'
                           ]
                        ]);
                },
                'baja' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-remove"></i>',['baja','IdUsuario' => $model['IdUsuario']], ['title' => 'Da de baja Usuario.', 'class' => 'btn btn-link']);
                },
                'activar' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-ok"></i>',['activar','IdUsuario' => $model['IdUsuario']], ['title' => 'Activa Usuario.','class' => 'btn btn-link']);
                }     
        ]
    ], 
] 

?>
  
<?= Yii::$app->session->getFlash('alert'); ?>

<div>
    <?= GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar' => [
            [
                'content' => 
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['alta'], ['title' => 'Crear nuevo Usuario.', 'class' => 'btn btn-success']).' '.
                    Html::a('<i class="glyphicon glyphicon-search"></i>', ['buscar'], ['title' => 'Busca Usuario.', 'class' => 'btn btn-default'])
            ]
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Usuarios</h3>',
            'type' => GridView::TYPE_PRIMARY,
        ],
    ]);   
    ?>
    
</div>


