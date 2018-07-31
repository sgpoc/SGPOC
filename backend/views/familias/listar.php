<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familias';
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
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['modificar','IdFamilia' => $model['IdFamilia']], ['title' => 'Modificar Familia.', 'class' => 'btn btn-link']);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['borrar','IdFamilia' => $model['IdFamilia']], ['title' => 'Borra Familia.', 'class' => 'btn btn-link',
                        'data' => [
                            'confirm' => 'Esta seguro que desea borrar la Familia?',
                            'method' => 'post'
                           ]
                        ]);
                },
                'listarsubfamilias' => function($url, $model, $key){
                    return Html::a('<i class="glyphicon glyphicon-user"></i>',['listar-subfamilias','IdFamilia' => $model['IdFamilia']], ['title' => 'Lista Subfamilias Familia.','class' => 'btn btn-link']);
                },    
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
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //'pjax' => true,
        'columns' => $gridColumns,
        'toolbar' => [
            [
                'content' => 
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['alta'], ['title' => 'Crear nueva Familia.', 'class' => 'btn btn-success']).' '.
                    Html::a('<i class="glyphicon glyphicon-search"></i>', ['buscar'], ['title' => 'Busca Familia.', 'class' => 'btn btn-default'])
            ],
            '{export}',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Familias</h3>',
            'type' => GridView::TYPE_PRIMARY,
        ],
    ]);   
    ?>
    
</div>