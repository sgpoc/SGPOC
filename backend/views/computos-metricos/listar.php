<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use app\models\GestorComputosMetricos;


$this->title = 'SGPOC | Cómputos Métricos';

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
            $pIdGT = Yii::$app->user->identity['IdGT'];
            $pIdComputoMetrico = $model['IdComputoMetrico'];
            $gestor = new GestorComputosMetricos;
            $computo = $gestor->Dame($pIdComputoMetrico);
            $tipoComputo = $computo[0]['TipoComputo'];
            if($tipoComputo == 'I')
            {
                $items = $gestor->ListarItems($pIdComputoMetrico, $pIdGT);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $items,
                    'pagination' => ['pagesize' => 5,],
                ]);
                return Yii::$app->controller->renderPartial('/computos-metricos/items', ['dataProvider' => $dataProvider]);
            }
            else{
                $elementos = $gestor->ListarElementos($pIdComputoMetrico, $pIdGT);
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $elementos,
                    'pagination' => ['pagesize' => 10,],
                ]);
                return Yii::$app->controller->renderPartial('/computos-metricos/elementos', ['dataProvider' => $dataProvider]);
            }
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true
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
        'attribute' => 'FechaComputoMetrico',
        'label' => 'Fecha Cómputo Métrico',            
        'vAlign' => 'middle',
        'hAlign' => 'center',            
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{agregar-linea} {modificar} {borrar}',
        'buttons' => [
                'agregar-linea' => function($url, $model, $key){
                    return  Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to(['/computos-metricos/agregar-linea', 'IdComputoMetrico' => $model['IdComputoMetrico']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Agregar nueva Linea al Cómputo Métrico'
                            ]);
                }, 
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/computos-metricos/modificar', 'IdComputoMetrico' => $model['IdComputoMetrico']]),
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Cómputo Métrico'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i>',
                            [
                                'borrar','IdComputoMetrico' => $model['IdComputoMetrico']
                            ], 
                            [
                                'title' => 'Borrar Cómputo Métrico', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar el Cómputo Métrico?',
                                    'method' => 'post'
                                ]
                            ]);
                }
        ]
    ], 
];

                
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
            'header'=>'<h2>Cómputos Métricos</h2>',
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
                'content' => Html::button('<i class="glyphicon glyphicon-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/computos-metricos/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Cómputo Métrico'
                            ]).' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', 
                            ['computos-metricos/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-book"></i> Cómputos Métricos</h3>',
            'type' => GridView::TYPE_DEFAULT,
        ],
    ]);   
    ?>
</div>
