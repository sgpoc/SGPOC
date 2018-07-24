<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos Trabajo';
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
        'attribute' => 'GrupoTrabajo',
        'label' => 'Nombre',
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
        'attribute' => 'Mail',
        'label' => 'Email',
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
        'template' => '{modificar} {borrar} {baja} {activar} {listarusuarios}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['modificar','IdGT' => $model['IdGT']], ['title' => 'Modificar Grupo Trabajo.', 'class' => 'btn btn-link']);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['borrar','IdGT' => $model['IdGT']], ['title' => 'Borra Grupo Trabajo.', 'class' => 'btn btn-link',
                        'data' => [
                            'confirm' => 'Esta seguro que desea borrar el Grupo de Trabajo?',
                            'method' => 'post'
                           ]
                        ]);
                },
                'listarusuarios' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-user"></i>',['listar-usuarios','IdGT' => $model['IdGT']], ['title' => 'Lista Usuarios Grupo Trabajo.','class' => 'btn btn-link']);
                },
                'baja' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-remove"></i>',['baja','IdGT' => $model['IdGT']], ['title' => 'Da de baja Grupo Trabajo.', 'class' => 'btn btn-link']);
                },
                'activar' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-ok"></i>',['activar','IdGT' => $model['IdGT']], ['title' => 'Activa Grupo Trabajo.','class' => 'btn btn-link']);
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
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['alta'], ['title' => 'Crear nuevo Grupo de Trabajo.', 'class' => 'btn btn-success']).' '.
                    Html::a('<i class="glyphicon glyphicon-search"></i>', ['buscar'], ['title' => 'Busca Grupo de Trabajo.', 'class' => 'btn btn-default'])
            ]
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Grupos de Trabajo</h3>',
            'type' => GridView::TYPE_PRIMARY,
        ],
    ]);   
    ?>
    
</div>


