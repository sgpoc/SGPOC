<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<?php
echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'enableEditMode'=>false,
    'panel'=>[
        'heading'=>$model['Proveedor'],
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes' => [
        [
            'attribute' => 'Página Web',
            'value' => Html::a('Ir a la página', 'https://'.''.$model['PaginaWEB'],['target' => '_blank']),
            'format' => 'raw'
           
        ],
        [
            'attribute' => 'Telefono',
            'value' => $model['Telefono']
        ],
        [
            'attribute' => 'Codigo Postal',
            'value' => $model['CodigoPostal']
        ],
    ]
    
]);

?>