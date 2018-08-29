<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/Login.css',
        
       'css/style.css',
//        'css/media-queries.css',
        "css/bootstrap.min.css",
        "css/font-awesome.min.css",
	"css/form-elements.css"
       
    ];
    public $js = [
       "js/jquery-1.11.1.min.js",
       "js/bootstrap.min.js",
       "js/jquery.backstretch.min.js",
       "js/scripts.js"
        
//        'js/jquery-ui.min.js',
//        'js/jquery.slimscroll.min.js',
//        'js/jquery.sparkline.min.js',
//        'js/bootstrap.min.js',
//        'plugins/iCheck/icheck.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}

