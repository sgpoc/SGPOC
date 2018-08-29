<?php

use kartik\detail\DetailView;
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
            'attribute' => 'Codigo Postal',
            'value' => $model['CodigoPostal']
        ],
        [
            'attribute' => 'Pagina WEB',
            'value' => $model['PaginaWEB']
        ],
    ]
    
]);

?>