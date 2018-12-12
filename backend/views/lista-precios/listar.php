<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use app\models\GestorListaPrecios;


$this->title = 'SGPOC | Lista de Precios';

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
            $pIdProveedor = $model['IdProveedor'];
            $pIdLocalidad = $model['IdLocalidad'];
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $gestor = new GestorListaPrecios;
            $insumos = $gestor->ListarInsumos($pIdProveedor, $pIdLocalidad, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $insumos,
                'pagination' => ['pagesize' => 5,],
            ]);
            return Yii::$app->controller->renderPartial('/lista-precios/insumos', ['dataProvider' => $dataProvider]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true,
        'expandIcon' => '<i class="far fa-plus-square"></i>',        
        'collapseIcon' => '<i class="far fa-minus-square"></i>',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Proveedor',
        'vAlign' => 'middle',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listDataP,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Localidad',
        'vAlign' => 'middle',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listDataL,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{agregar-insumo} {borrar} {exportar}',
        'buttons' => [
                'agregar-insumo' => function($url, $model, $key){
                    return  Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to(['/lista-precios/agregar-insumo', 'IdProveedor' => $model['IdProveedor'], 'IdLocalidad' => $model['IdLocalidad']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Agregar Insumo a la Lista de Precios'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash"></i>',
                            [
                                'borrar','IdProveedor' => $model['IdProveedor'],'IdLocalidad' => $model['IdLocalidad']
                            ], 
                            [
                                'title' => 'Borrar Lista de Precios', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar la Lista de Precios? Se borrara la lista aunque tenga insumos asociados',
                                    'method' => 'post'
                                ]
                            ]);
                }, 
                'exportar' => function($url, $model, $key){
                    return Html::a('<i class="fas fa-external-link-alt"></i>',
                            [
                                'exportar', 'IdProveedor' => $model['IdProveedor'],'IdLocalidad' => $model['IdLocalidad']
                            ], 
                            [
                                'target' => '_blank', 
                                'class'=>'btn btn-link',  
                                'title'=>'exportar' ,
                                'data-pjax' => 0,   
                            ]);
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
            'header'=>'<h2>Lista Precios</h2>',
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
                'content' =>Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/lista-precios/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Lista de Precios'
                            ]).' '.
                            Html::a('<i class="fa fa-redo"></i>', 
                            ['lista-precios/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-file-invoice-dollar"></i> Lista de Precios</h3>',
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
