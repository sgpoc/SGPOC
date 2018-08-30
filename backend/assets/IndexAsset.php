<?php

namespace backend\assets;
use Yii;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/Indexstyle.css',
    
    ];
    public $js = [
  
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}


