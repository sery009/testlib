<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetLc extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'lc/css/style.css?v=1.40',
        'lc/css/my.css?v=1.41'
    ];
    public $js = [
        "lc/js/jquery-3.5.0.min.js",
        "lc/js/selectivizr-min.js",
        "lc/js/mask.js",
        "https://player.vimeo.com/api/player.js",

        "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js",
        "lc/js/slick.min.js",
        "lc/js/app.js?v=1.41",
        "lc/js/my.js?v=1.50",
        "lc/js/new-app.js?v=1.39",



    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
