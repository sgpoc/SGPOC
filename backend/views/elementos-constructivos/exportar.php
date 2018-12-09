<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


?>

<?= GridView::widget([
    'dataProvider' => $dataProviderElemento,
    'columns' => [
        [
        'attribute' => 'ElementoConstructivo',
        'label' => 'Elemento Constructivo',
        ],
        [
        'attribute' => 'RubroEC',
        'label' => 'Rubro del Elemento',
        ],
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProviderItem,
    'columns' => [
        'Item',
        [
        'attribute' =>  'Abreviatura',
        'label' => 'Unidad',
        ],
        'attribute' =>  'Incidencia',
    ],
]); 
?>