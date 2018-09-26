<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/font-awesome.min.css',
        'css/ionicons.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'css/AdminLTE.min.css',
    ];
    public $js = [
        'js/jquery-ui.min.js',
        'js/raphael.min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.slimscroll.min.js',
        'js/fastclick.js',
        'js/dashboard.js',
        'js/main.js',
        'js/custom.js',
        'js/adminlte.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}


