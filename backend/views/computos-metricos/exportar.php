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
        'Obra',
        'Descripcion',
        [
        'attribute' => 'FechaComputoMetrico',
        'label' => 'Fecha del Computo Metrico',
        ],
        [
        'attribute' => 'TipoComputo',
        'label' => 'Tipo de Computo',
        ],
    ],
]); ?>

<?php if($tipoComputo == 'I'):?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'Item',
        [
        'attribute' =>  'RubroItem',
        'label' => 'Rubro del Item',
        ],
        [
        'attribute' =>  'Descripcion',
        ],
        'Cantidad',
        'Largo',
        'Ancho',
        'Alto',
        [
            'attribute' =>  'Abreviatura',
            'label' => 'Unidad',
        ],
        'Parcial'
    ],
]); 

?>
<?php endif; ?>

<?php if($tipoComputo == 'E'):?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' =>  'ElementoConstructivo',
            'label' => 'Elemento Constructivo',
        ],
        [
        'attribute' =>  'RubroEC',
        'label' => 'Rubro del Elemento',
        ],
        [
        'attribute' =>  'Descripcion',
        ],
        'Cantidad',
        'Largo',
        'Ancho',
        'Alto',
        [
            'attribute' =>  'Abreviatura',
            'label' => 'Unidad',
        ],
        'Parcial'
    ],
]); 

?>
<?php endif; ?>
