<?php

namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        //'//fonts.googleapis.com/css?family=Rokkitt:400,600'
        //'//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
        '//fonts.googleapis.com/css?family=Maven+Pro:400,500,700'
    ];
    
    public $cssOptions = [
        'type' => 'text/css',
    ];
}



