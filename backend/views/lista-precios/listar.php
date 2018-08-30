<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use app\models\GestorListaPrecios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
                'pagination' => ['pagesize' => 15,],
            ]);
            return Yii::$app->controller->renderPartial('/lista-precios/insumos', ['dataProvider' => $dataProvider]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true
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
        'template' => '{agregar-insumo}',
        'buttons' => [
                'agregar-insumo' => function($url, $model, $key){
                    return  Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to(['/lista-precios/agregar-insumo', 'IdProveedor' => $model['IdProveedor'], 'IdLocalidad' => $model['IdLocalidad']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Agregar Insumo a la Lista de Precios'
                            ]);
                }, 
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
                                'value'=>Url::to('/sgpoc/backend/web/lista-precios/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Lista de Precios'
                            ]).' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', 
                            ['lista-precios/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-money"></i> Lista de Precios</h3>',
            'type' => GridView::TYPE_DEFAULT,
        ],
    ]);   
    ?>
</div>
