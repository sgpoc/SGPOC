<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/font-aweasome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        '/plugins/iCheck/square/blue.css',
    ];
    public $js = [
        'js/jquery-3.3.1.js',
        'js/bootstrap/bootstrap.min.js',
        'js/jquery-ui.min.js',
        'js/raphael-min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.slimscroll.min.js',
        'js/fastclick.js',
        'js/adminlte.min.js',
        'js/dashboard.js',
        'js/main.js',
        'js/custom.js',
        'js/bootbox.min.js',
        'plugins/iCheck/icheck.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}


