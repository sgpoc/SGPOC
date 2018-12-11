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
    'dataProvider' => $dataProviderInsumos,
    'columns' => [
        'Insumo',
        [
        'attribute' =>  'TipoInsumo',
        'label' => 'Tipo de Insumo',
        ],
        [
        'attribute' =>  'Familia',
        ],
        [
        'attribute' =>  'SubFamilia',
        ],
        [
            'attribute' =>  'PrecioU',
            'label' => 'Precio Unitarios',
        ],
        [
            'attribute' =>  'Beneficios',
        ],
        [
            'attribute' =>  'GastosGenerales',
        ],
        [
            'attribute' =>  'CargasSociales',
        ],
        [
            'attribute' =>  'IVA',
        ],
        [
            'attribute' =>  'Precio',
            'label' => 'Precio (C/P)'
        ],
        [
            'attribute' => 'Proveedor',
        ],
        [
            'attribute' => 'Localidad',
        ],
        [
            'attribute' => 'FechaUltimaActualizacion',
            'label' => 'Fecha Ultima Actualización',
        ],
    ],
]); 
?>