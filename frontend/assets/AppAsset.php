<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/bootstrap.css',
//        'css/bootstrap-extended.css',
        'css/colors.css',
        'css/font-awesome.css',
        'css/icofont.css',
        'css/plugins.css',
        'css/style.css',
        'css/site.css',
        'css/responsive.css',
    ];
    public $js = [
//        '/js/jquery.js',
//        '/js/jquery.main.js',
//        '/js/particle.js',
//        '/js/plugins.js',
        '/js/jquery.mask.min.js',
        '/js/site.js',
//        '/js/slide.js',
//        '/js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
