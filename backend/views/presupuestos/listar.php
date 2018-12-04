<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use app\models\GestorComputosMetricos;
use app\models\GestorPresupuestos;
use app\models\Presupuestos;


$this->title = 'SGPOC | Presupuestos';

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
        'hiddenFromExport' =>  false,
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            $pIdComputoMetrico = $model['IdComputoMetrico'];
            $pIdPresupuesto = $model['IdPresupuesto'];
            $gestor = new GestorComputosMetricos;
            $gestorp = new GestorPresupuestos;
            $computo = $gestor->Dame($pIdComputoMetrico);
            $tipoComputo = $computo[0]['TipoComputo'];
            if($tipoComputo == 'I')
            {
                $items = $gestorp->ListarItems($pIdPresupuesto);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $items,
                    'pagination' => ['pagesize' => 5,],
                ]);
                return Yii::$app->controller->renderPartial('/presupuestos/items', ['dataProvider' => $dataProvider]);
            }
            else{
                $elementos = $gestorp->ListarElementos($pIdPresupuesto);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $elementos,
                    'pagination' => ['pagesize' => 5,],
                ]);
                return Yii::$app->controller->renderPartial('/presupuestos/elementos', ['dataProvider' => $dataProvider]);
            }
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
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listDataO,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'FechaDePresupuesto',
        'label' => 'Fecha Presupuesto',            
        'vAlign' => 'middle',
        'hAlign' => 'center',            
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Descripcion',
        'label' => 'Cómputo Métrico',            
        'vAlign' => 'middle',
        'hAlign' => 'center',            
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'value' => function($model){
            $gestor = new GestorPresupuestos;
            $pIdPresupuesto = $model['IdPresupuesto'];
            $preciototal = $gestor->CalculoPrecioTotal($pIdPresupuesto);
            return $preciototal[0]['PrecioTotal'];
        },
        'label' => 'Precio Total',            
        'vAlign' => 'middle',
        'hAlign' => 'center',   
        'format' => ['decimal',2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {listar-insumos}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil-alt"></i>',
                            [
                                'value'=>Url::to(['/presupuestos/modificar', 'IdPresupuesto' => $model['IdPresupuesto']]),
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Presupuesto'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash"></i>',
                            [
                                'borrar','IdPresupuesto' => $model['IdPresupuesto']
                            ], 
                            [
                                'title' => 'Borrar Presupuesto', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar el Presupuesto?',
                                    'method' => 'post'
                                ]
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
            'header'=>'<h2>Presupuestos</h2>',
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
                GridView::PDF => [
                    'label' => 'PDF',
                    'label' => 'PDF',
                    'filename' => 'presupuesto-items',
                    'showHeader' => false,
                    //'showFooter' => false,
                    'showPageSummary' => false,
                ],
         ],
        'toolbar' => [
            [
                'content' => Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/presupuestos/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Presupuesto'
                            ]).' '.Html::a('<i class="fa fa-wrench"></i>',
                            [
                                'listar-insumos'
                            ], 
                            [
                                'title' => 'Listar Presupuesto por Insumos', 
                                'class' => 'btn btn-default',
                            ]).' '.
                            Html::a('<i class="fa fa-redo"></i>', 
                            ['presupuestos/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'export' => [
            'icon' => 'fa fa-external-link-alt',
            'showConfirmAlert' => false,
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-dollar-sign"></i> Presupuestos</h3>',
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
