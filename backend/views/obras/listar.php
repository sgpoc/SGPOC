<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'SGPOC | Obras';

$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'header' => '#',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('/obras/detalles', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true,
        'expandIcon' => '<i class="far fa-plus-square"></i>',        
        'collapseIcon' => '<i class="far fa-minus-square"></i>',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Obra',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Localidad',
        'label' => 'Localidad',
        'vAlign' => 'middle',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listDataL,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Direccion',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Estado',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $estados,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'value' => function($model, $key, $index, $column) {
                if($model['Estado'] == 'A'){
                    return '<span class="glyphicon glyphicon-ok" style="color:green"></span>';
                }
                if($model['Estado'] == 'B'){
                    return '<span class="glyphicon glyphicon-remove" style="color:firebrick"></span>';
                }
                else{
                    return '<span class="glyphicon glyphicon-ok" style="color:gold"></span>';                }
        }
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {baja} {activar} {finalizar}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil-alt"></i>',
                            [
                                'value'=>Url::to(['/obras/modificar', 'IdObra' => $model['IdObra']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Obra'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash"></i>',
                            [
                                'borrar','IdObra' => $model['IdObra']
                            ], 
                            [
                                'title' => 'Borrar Obra', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar la Obra?',
                                    'method' => 'post'
                                ]
                            ]);
                },        
                'baja' => function($url, $model, $key){
                    if($model['Estado'] === 'A'){
                        return  Html::a('<i class="fa fa-toggle-on"></i>',
                                [
                                    'baja','IdObra' => $model['IdObra']
                                ], 
                                [
                                    'title' => 'Dar de baja Obra', 
                                    'class' => 'btn btn-link'
                                ]);
                    }
                },
                'activar' => function($url, $model, $key){
                    if($model['Estado'] === 'B' || $model['Estado'] === 'F'){
                        return Html::a('<i class="fa fa-toggle-off"></i>',
                                [
                                    'activar','IdObra' => $model['IdObra']
                                ], 
                                [
                                    'title' => 'Activar Obra',
                                    'class' => 'btn btn-link'
                                ]);
                    }
                },
                'finalizar' => function($url, $model, $key){
                    if($model['Estado'] === 'F'){
                        return Html::a('<i class="fas fa-circle"></i>',
                                [
                                    'finalizar','IdObra' => $model['IdObra']
                                ], 
                                [
                                    'class' => 'btn btn-link'
                                ]);
                        
                    }
                    else{
                        return Html::a('<i class="far fa-circle"></i>',
                                [
                                    'finalizar','IdObra' => $model['IdObra']
                                ], 
                                [
                                    'title' => 'Finalizar Obra',
                                    'class' => 'btn btn-link'
                                ]);
                        
                    }
                } 
        ]
    ], 
];

                
?>
  
<?php if(Yii::$app->session->getFlash('alert')){
            if(substr(Yii::$app->session->getFlash('alert'), 0, 2) != 'OK') {
                echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'icon' => 'glyphicon glyphicon-remove-sign',
                'body' => Yii::$app->session->getFlash('alert'),
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
            else {
                echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('alert'),
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
        }
?>

<?php
    Modal::begin([
            'header'=>'<h2>Obras</h2>',
            'footer'=>'',
            'id'=>'modal',
            'size'=>'modal-lg',
       ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>

<div>
    <?= GridView::widget([
        'id' => 'gridview',
        'moduleId' => 'gridviewKrajee',
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'options' => [
                'id' => 'gridview'
            ]
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'exportConfig' => [
                GridView::EXCEL => ['label' => 'EXCEL'],
                GridView::PDF => ['label' => 'PDF'],
         ],
        'toolbar' => [
            [
                'content' => Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/obras/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Obra'
                            ]).' '.
                            Html::a('<i class="fa fa-redo"></i>', 
                            ['obras/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'export' => [
          'icon' => 'fa fa-external-link-alt'  
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-building"></i> Obras</h3>',
            'type' => GridView::TYPE_DEFAULT,
        ],
        'hover' => true,
        'bordered' => false,
        'striped' => false,
        'condensed' => true,
        'responsive' => true,
        'responsiveWrap' => true,
    ]);   
    ?>
</div>
