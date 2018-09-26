<?php

namespace backend\assets;
use Yii;
use yii\web\AssetBundle;
use yii\web\View;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/Indexstyle.css',
    
    ];
    public $js = [
        'js/jquery-3.3.1.js',
        'js/index.js',
        'js/custom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}


