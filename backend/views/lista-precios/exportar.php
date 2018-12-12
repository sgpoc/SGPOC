<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


?>

<?= GridView::widget([
    'dataProvider' => $dataProviderLista,
    'columns' => [
        [
        'attribute' => 'Proveedor',
        ],
        [
        'attribute' =>  'Localidad',
        ]
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProviderInsumos,
    'columns' => [
        'Insumo',
        [
        'attribute' =>  'TipoInsumo',
        'label' => 'Tipo de Insumo',
        ],
        'Familia',
        'SubFamilia',
        [
        'attribute' =>  'PrecioLista',
        'label' => 'Precio de Lista',
        ],
        'attribute' =>  'FechaUltimaActualizacion',
    ],
]); 
?>