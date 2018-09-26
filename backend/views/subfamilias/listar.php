<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'SGPOC | SubFamilias';

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
        'attribute' => 'SubFamilia',
        'label' => 'SubFamilia',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Familia',
        'vAlign' => 'middle',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> $listData,
        'filterInputOptions' => ['placeholder' => ''],
        'format' => 'raw',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {listarinsumos}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil-alt"></i>',
                            [
                                'value'=>Url::to(['/subfamilias/modificar', 'IdSubFamilia' => $model['IdSubFamilia']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar SubFamilia'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash"></i>',
                            ['borrar','IdSubFamilia' => $model['IdSubFamilia']], 
                            [
                                'title' => 'Borrar SubFamilia', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar esta SubFamilia?',
                                    'method' => 'post'
                                ]
                            ]);
                },
                'listarinsumos' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-wrench"></i>',
                            ['listar-insumos','IdSubFamilia' => $model['IdSubFamilia']], 
                            [
                                'title' => 'Listar Insumos',
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
            'header'=>'<h2>SubFamilias</h2>',
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
                GridView::TEXT => ['label' => 'TEXTO'],
                GridView::PDF => ['label' => 'PDF'],
         ],
        'toolbar' => [
            [
                'content' => Html::button('<i class="fa fa-plus"></i>',
                            [
                                'value'=>Url::to('/sgpoc/backend/web/subfamilias/alta'), 
                                'class'=>'btn btn-success modalButton',
                                'title'=>'Crear SubFamilia'
                            ]).' '.
                            Html::a('<i class="fa fa-redo"></i>', 
                            ['subfamilias/listar'], 
                            [
                                'data-pjax' => 0, 
                                'class' => 'btn btn-default', 
                                'title' => 'Actualizar'
                            ])
            ],
            '{export}',
        ],
        'export' =>[
          'icon' => 'fa fa-external-link-alt',  
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fa fa-th-list"></i> SubFamilias</h3>',
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