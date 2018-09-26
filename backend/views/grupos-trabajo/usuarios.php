<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'SGPOC | Usuarios Grupo Trabajo';

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
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'Estado',
        'vAlign' => 'middle',
        'hAlign' => 'center'
    ],/*
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar} {baja} {activar}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/usuarios/modificar', 'IdUsuario' => $model['IdUsuario']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Usuario'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i>',
                            [
                                'borrar','IdUsuario' => $model['IdUsuario']
                            ], 
                            [
                                'title' => 'Borrar Usuario', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar el Usuario?',
                                    'method' => 'post'
                                ]
                            ]);
                },        
                'baja' => function($url, $model, $key){
                    if($model['Estado'] === '1'){
                        return  Html::a('<i class="fa fa-toggle-on"></i>',
                                [
                                    'baja','IdUsuario' => $model['IdUsuario']
                                ], 
                                [
                                    'title' => 'Dar de baja Usuario', 
                                    'class' => 'btn btn-link'
                                ]);
                    }
                },
                'activar' => function($url, $model, $key){
                    if($model['Estado'] === '0'){
                        return Html::a('<i class="fa fa-toggle-off"></i>',
                                [
                                    'activar','IdUsuario' => $model['IdUsuario']
                                ], 
                                [
                                    'title' => 'Activar Usuario',
                                    'class' => 'btn btn-link'
                                ]);
                    }
                }     
        ]
    ],*/ 
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
            'header'=>'<h2>Usuarios</h2>',
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
        'columns' => $gridColumns,/*
        'exportConfig' => [
                GridView::EXCEL => ['label' => 'Descargar como EXCEL'],
                GridView::TEXT => ['label' => 'Descargar como TEXTO'],
                GridView::PDF => ['label' => 'Descargar como PDF'],
         ],*/
    ]);   
    ?>
</div>


