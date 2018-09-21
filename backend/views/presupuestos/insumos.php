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
        'attribute' => 'PrecioU',
        'label' => 'Precio Unitario',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Beneficios',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'GastosGenerales',
        'label' => 'Gastos Generales',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'CargasSociales',
        'label' => 'Cargas Sociales',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'IVA',
        'label' => 'IVA',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
        'contentOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'Precio',
        'label' => 'Precio (C/P)',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
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
        'template' => '{modificar-porcentajes} {eleccion-precio}',
        'buttons' => [
                'modificar-porcentajes' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-pencil"></i>',
                            [
                                'value'=>Url::to(['/presupuestos/modificar-porcentajes','IdPresupuesto' =>$model['IdPresupuesto'], 'IdInsumo' => $model['IdInsumo']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Modificar Porcentajes Insumo'
                            ]);
                },
                'eleccion-precio' => function($url, $model, $key){ 
                    return  Html::button('<i class="fa fa-dollar"></i>',
                            [
                                'value'=>Url::to(['/presupuestos/eleccion-precio','IdPresupuesto' =>$model['IdPresupuesto'], 'IdInsumo' => $model['IdInsumo']]), 
                                'class'=>'btn btn-link modalButton',
                                'title'=>'Elegir Lista de Precios'
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


