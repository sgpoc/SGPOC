<?php //

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Url;


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
        'attribute' => 'Insumo',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'TipoInsumo',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Familia',
        'label' => 'Familia',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
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
        'attribute' => 'PrecioLista',
        'label' => 'Precio de Lista',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'FechaUltimaActualizacion',
        'label' => 'Fecha Ultima Actualización',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {borrar}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/lista-precios/modificar-insumo', 'IdInsumo' => $model['IdInsumo'], 'IdProveedor' => $model['IdProveedor'], 'IdLocalidad' => $model['IdLocalidad']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Insumo en Lista de Precio'
                            ]);
                },
                'borrar' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-trash-o"></i>',
                            [
                                'borrar-insumo', 'IdInsumo' => $model['IdInsumo'],  'IdProveedor' => $model['IdProveedor'], 'IdLocalidad' => $model['IdLocalidad']
                            ], 
                            [
                                'title' => 'Borrar Insumo de la Lista de Precio', 
                                'class' => 'btn btn-link',
                                'data' => [
                                    'confirm' => 'Esta seguro que desea borrar el Insumo de la Lista de Precio?',
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
            'header'=>'<h2>Insumos</h2>',
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
        'columns' => $gridColumns
    ]);   
    ?>
</div>


