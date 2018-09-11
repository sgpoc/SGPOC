<?php 

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
        'attribute' => 'Item',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'RubroItem',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Abreviatura',
        'label' => 'Unidad',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'CostoDirecto',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Beneficios',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'GastosGenerales',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'CargasSociales',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'IVA',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'PrecioTotal',
        'label' => 'Precio Total',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Acciones',
        'vAlign' => 'middle',
        'width' => '240px',
        'template' => '{modificar} {eleccion-precio}',
        'buttons' => [
                'modificar' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/presupuestos/modificar-linea', 'IdPresupuesto' => $model['IdPresupuesto'], 'IdItem' => $model['IdItem']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Línea Presupuesto'
                            ]);
                },
                'eleccion-precio' => function($url, $model, $key){
                    return Html::a('<i class="fa fa-dollar"></i>',
                            [
                                'eleccion-precio', 'IdPresupuesto' => $model['IdPresupuesto'], 'IdItem' => $model['IdItem'],
                            ], 
                            [
                                'title' => 'Elegir Lista de Precios', 
                                'class' => 'btn btn-link',
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


