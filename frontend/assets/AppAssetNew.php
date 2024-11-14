<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetNew extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'game/css/style.css?v=1.36',
        'game/css/my.css?v=1.36'
    ];
    public $js = [
        "game/js/jquery-3.5.0.min.js",
        "game/js/selectivizr-min.js",
        "game/js/mask.js",
        "game/js/jquery.scrollbar.min.js",
        "game/js/app.js?v=1.35",


    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
