<?php

/* @var $this yii\web\View */

$this->title = 'Как заработать';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="page_title">
        <h1 class="study__heading">
            Информация <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M18.272,3.934A14.509,14.509,0,1,0,32.781,18.443,14.509,14.509,0,0,0,18.272,3.934Zm0,26.045A11.536,11.536,0,1,1,29.808,18.443,11.549,11.549,0,0,1,18.272,29.979Zm-4.043-12.19H17.38v7.79h2.973V14.816H14.229v2.973Zm5.886-7.314H17.142v2.854h2.973V10.475Z"/>
            </svg>
        </h1>
    </div>
    <div class="page_box">

        <h4 style="margin-top: 20px">Почта</h4>
        <div style="padding:72.25% 0 0 0;position:relative;margin: 20px 0">
            <iframe src="https://player.vimeo.com/video/1026223317" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
            <img src="https://i.vimeocdn.com/video/1440519900-1ed64e863a5bdccc920bfbc297ba222da8b5d35a2629d42914fd601615a42902-d?mw=1300&mh=731"
                 alt="" class="" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;">
        </div><script src="https://player.vimeo.com/api/player.js"></script>


    </div>
    <div class="page_footer">
        <a href="<?php echo yii\helpers\Url::to(['site/index'])?>">На главную</a>
        <a href="<?php echo yii\helpers\Url::to(['learn/index'])?>">В раздел обучения</a>
    </div>
</div>
