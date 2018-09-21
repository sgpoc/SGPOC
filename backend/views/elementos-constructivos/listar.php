
<?php

use yii\helpers\Html;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\GestorElementosConstructivos;
use yii\data\ArrayDataProvider;
use yii\widgets\Pjax;



$this->title = 'SGPOC | Elementos Constructivos';

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
            $pIdElementoConstructivo = $model['IdElementoConstructivo'];
            $gestor = new GestorElementosConstructivos;
            $items = $gestor->ListarItems($pIdElementoConstructivo, $pIdGT);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $items,
                'pagination' => ['pagesize' => 15,],
            ]);
            return Yii::$app->controller->renderPartial('/elementos-constructivos/items', ['dataProvider' => $dataProvider]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'ElementoConstructivo',
        'label' => 'Nombre',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'RubroEC',
        'label' => 'Rubro Elemento Constructivo',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listDataREC,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
                        
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{agregar-item} {modificar} {borrar}',
        'buttons' => [
                'agregar-item' => function($url, $model, $key){
                    return  Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to(['/elementos-constructivos/agregar-item', 'IdElementoConstructivo' => $model['IdElementoConstructivo']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Agregar Item al Elemento'
                            ]);
                }, 
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/elementos-constructivos/modificar', 'IdElementoConstructivo' => $model['IdElementoConstructivo']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Elemento Constructivo'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i>',
                            ['borrar','IdElementoConstructivo' => $model['IdElementoConstructivo']], 
                            [
                                'title' => 'Borrar Elemento Constructivo', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar el Elemento?',
                                    'method' => 'post'
                                ]
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
            'header'=>'<h2>Elementos</h2>',
            'footer'=>'',
            'id'=>'modal',
            'size'=>'modal-lg',
       ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>

<?php Pjax::begin(['id'=>'some_pjax_id']); ?>
<div>
    <?= GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'pjax' => true,
        'exportConfig' => [
                GridView::EXCEL => ['label' => 'Descargar como EXCEL'],
                GridView::TEXT => ['label' => 'Descargar como TEXTO'],
                GridView::PDF => ['label' => 'Descargar como PDF'],
         ],
        'toolbar' => [
            [
                'content' =>Html::button('<i class="glyphicon glyphicon-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/elementos-constructivos/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear Elemento'
                            ]).' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', 
                            ['elementos-constructivos/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-list"></i> Elementos Constructivos</h3>',
            'type' => GridView::TYPE_DEFAULT,
        ],
    ]);   
    ?>
</div>
<?php Pjax::end(); ?>


