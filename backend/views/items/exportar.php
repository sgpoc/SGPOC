<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


?>

<?= GridView::widget([
    'dataProvider' => $dataProviderItem,
    'columns' => [
        'Item',
        [
        'attribute' => 'RubroItem',
        'label' => 'Rubro Item',
        ],
        [
        'attribute' =>  'Abreviatura',
        'label' => 'Unidad',
        ]
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProviderInsumos,
    'columns' => [
        'Insumo',
        'TipoInsumo',
        'Familia',
        'SubFamilia',
        [
        'attribute' =>  'Abreviatura',
        'label' => 'Unidad',
        ],
        'attribute' =>  'Incidencia',
    ],
]); 
?>