<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


?>

<?= GridView::widget([
    'dataProvider' => $dataProviderPresupuesto,
    'columns' => [
        'Obra',
        [
        'attribute' => 'FechaDePresupuesto',
        'label' => 'Fecha Presupuesto',
        ],
        [
            'attribute' => 'Descripcion',
            'label' => 'Computo Metrico'
        ],
        [
            'attribute' => 'PrecioTotal',
        ],
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProviderItems,
    'columns' => [
        [
            'attribute' => 'Item',
        ],
        [
            'attribute' => 'RubroItem',
        ],
        [
            'attribute' => 'Abreviatura',
            'label' => 'Unidad',
        ],
        [
            'attribute' => 'Precio',
        ],
    ],
]); 
?>