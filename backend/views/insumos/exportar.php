<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use kartik\detail\DetailView;
use yii\widgets\ListView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' =>  'Insumo',
          
        ],
        [
            'attribute' =>  'TipoInsumo',
            'label' => 'Tipo de Insumo'
        ],
        [
            'attribute' =>  'Familia',
          
        ],
        [
            'attribute' =>  'SubFamilia',
          
        ],
        [
            'attribute' =>  'Abreviatura',
            'label' => 'Unidad'
        ],

    ],
]); 


?>



