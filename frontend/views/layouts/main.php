<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;


\frontend\assets\AppAssetLc::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta id="viewport" name="viewport">
    <script>
        let meta_viewport = document.getElementById("viewport");
        viewPort();
        window.addEventListener("resize", function() {
            viewPort();
        });
        function viewPort(){
            if (screen.width < 641) {
                meta_viewport.setAttribute("content", 'width=375, user-scalable=0')
            }
            else if (screen.width < 1081){
                meta_viewport.setAttribute("content", 'width=device-width, initial-scale=.75')
            }
            else {
                meta_viewport.setAttribute("content", 'width=device-width, initial-scale=1.0')
            }
        }
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Liberty game</title>
    <!--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />-->


    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="/fav/site.webmanifest">
    <link rel="mask-icon" href="/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">



    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="page_wrapper">

    <div class="sign-up">
        <div class="container" style="padding-top: 40px;max-width: 1040px;position: relative;z-index: 1">
            <div class="">
                <div class="h_links" >
                    <a href="/" class="login" style="color:rgb(0, 165, 226)">Назад</a>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: -60px">
            <div class="sign-up__content">
                <a href="<?php echo \yii\helpers\Url::to(['site/index'])?>" class="sign-up__logo">
                    <img src="/lc/img/sign-up-logo.png" alt="" class="sign-up__logo-image">
                </a>
                <div class="sign-up__top-text">
                    Образовательная программа с элементами игры
                    и гибридным алгоритмом распределения средств
                </div>

                <?= $content ?>

                <div class="sign-up__copyright">
                    © Libertygame Ltd. <?php echo date('Y')?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(92030452, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/92030452" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
