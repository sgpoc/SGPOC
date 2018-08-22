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
        'heading'=>$model['Obra'],
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes' => [
        [
            'attribute' => 'Propietario',
            'value' => $model['Propietario']
        ],
        [
            'attribute' => 'Email',
            'value' => $model['Email']
        ],
        [
            'attribute' => 'Comentarios',
            'value' => $model['Comentarios']
        ],
        [
            'attribute' => 'SuperficieTerreno',
            'value' => $model['SuperficieTerreno']
        ],
        [
            'attribute' => 'SuperficieCubiertaTotal',
            'value' => $model['SuperficieCubiertaTotal']
        ],
    ]
    
]);

?>