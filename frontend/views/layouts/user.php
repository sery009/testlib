<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\frontend\assets\AppAssetLc::register($this);
$user=Yii::$app->user->identity;
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
                meta_viewport.setAttribute("content", 'width=480px, user-scalable=0')
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
    <?php echo $this->render('//layouts/_header');?>

    <main>
        <div class="container">
            <div class="main">
                <?php echo $this->render('//layouts/_left',['user'=>$user]);?>
                <?= $content ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="copyright">
                <p>© Libertygame Ltd. <?php echo date('Y')?></p>
            </div>
        </div>
    </footer>
</div>
<?php echo $this->render('//layouts/_modals');?>
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
