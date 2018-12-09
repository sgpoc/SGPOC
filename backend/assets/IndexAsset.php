<?php

namespace backend\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/index-style.css',
    ];
    public $js = [
       'js/jquery-3.3.1.js',
        'js/index.js',
        'js/custom.js'
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}


