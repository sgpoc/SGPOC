<?php
return [
    'id' => 'app-backend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'rules' => [
        ],
     ],
    ],
];
