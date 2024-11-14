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
        'css3/style.css?v=1.9',
        'css3/fonts.css',
        'css3/my.css?v=1.26',
        'https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap'
    ];
    public $js = [
        'https://code.jquery.com/jquery.min.js',
        'js2/jquery-ui.min.js?v=1.0',
        'js2/jquery.ui.touch-punch.min.js',
        'js2/jquery.nicescroll.js',
        'js2/selectbox.js',
        'js2/scripts.js?v=1.12'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
