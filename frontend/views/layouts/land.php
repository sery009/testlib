<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAssetNew;
use yii\helpers\Html;


AppAssetNew::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Liberty game</title>
    <!--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />-->
    <meta charset="utf-8">
    <meta id="viewport" name="viewport">
    <script>
        let meta_viewport = document.getElementById("viewport");
        viewPort();
        window.addEventListener("resize", function() {
            viewPort();
        });
        function viewPort(){
            if (screen.width < 641) {
                meta_viewport.setAttribute("content", 'width=480, user-scalable=0')
            } else {
                meta_viewport.removeAttribute("content")
            }
        }
    </script>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>



    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="/fav/site.webmanifest">
    <link rel="mask-icon" href="/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">






    <?php $this->head() ?>
</head>
<body data-time="2024-06-03T14:00:00">
<?php $this->beginBody() ?>

            <?= $content ?>

<?php $this->endBody() ?>
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
</body>
</html>
<?php $this->endPage() ?>
