<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
$user=Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<body data-goal_time="<?php echo date('m/d/Y H:i',strtotime($user->goal_time))?>">
<?php $this->beginBody() ?>
<div class="wrapper">
    <!--<img src="/images/bg.jpg" alt="" class="bg">-->
    <div class="mob_top">
        <a href="/user/index"><img src="/images/logo3.png" alt="" class="mt_logo"></a>
        <a class="burger"><span></span></a>
    </div>
    <div class="left_panel">
        <div class="lp_content">
            <a href="/user/index" class="logo"><img src="/images/logo3.png" alt=""></a>

            <ul class="nav">
                <li class="pop <?php if(in_array(Yii::$app->controller->action->id,['desktop','marketing','my','users'])||(Yii::$app->controller->action->id=='index'&&Yii::$app->controller->id=='invest'))echo'opened';?>"><a href="javascript:void(0)"><img src="/images/trend.svg" alt=""><span>InvestClub</span></a>
                    <ul <?php if(in_array(Yii::$app->controller->action->id,['desktop','marketing','my','users'])||(Yii::$app->controller->action->id=='index'&&Yii::$app->controller->id=='invest'))echo'style="display:block"';?>>
                        <li><a href="/user/desktop"><img src="/images/pc.svg" alt=""><span>Рабочий стол</span></a></li>
                        <li><a href="/invest/index"><img src="/images/speedometer.svg" alt=""><span>Средний риск</span></a></li>
                        <li><a href="/invest/marketing"><img src="/images/briefcase.svg" alt=""><span>Маркетинг</span></a></li>
                        <li><a href="/invest/my"><img src="/images/inv.svg" alt=""><span>Мои инвестиции</span></a></li>
                        <li><a href="/invest/users"><img src="/images/deal.svg" alt=""><span>Мои партнеры</span></a></li>
                    </ul>
                </li>
                <li class="pop <?php  if(in_array(Yii::$app->controller->action->id,['index','levels'])&&Yii::$app->controller->id=='user')echo'opened';?>"><a href="javascript:void(0)"><img src="/images/games.svg" alt=""><span>Game</span></a>
                    <ul <?php  if(in_array(Yii::$app->controller->action->id,['index','levels'])&&Yii::$app->controller->id=='user')echo'style="display:block"';?>>
                        <li><a href="/user/index"><img src="/images/pc.svg" alt=""><span>Рабочий стол</span></a></li>
                        <li><a href="/user/levels"><img src="/images/ll.svg" alt=""><span>Уровни</span></a></li>
                    </ul>
                </li>
                <li class="pop <?php  if(Yii::$app->controller->id=='program')echo'opened';?>"><a href="javascript:void(0)"><img src="/images/prod.svg" alt=""><span>Product</span></a>
                    <ul <?php  if(Yii::$app->controller->id=='program')echo'style="display:block"';?>>
                        <li><a href="/program/auto"><img src="/images/prod_1.svg" alt=""><span>Автомобили</span></a></li>
                        <li><a href="/program/home"><img src="/images/prod_2.svg" alt=""><span>Недвижимость</span></a></li>
                        <li><a href="/program/other"><img src="/images/prod_3.svg" alt=""><span>Товары</span></a></li>
                    </ul>
                </li>
                <li><a href="/learn/index"><img src="/images/book.svg" alt=""><span>Обучение</span></a></li>
                <li><a href="/money/wallet"><img src="/images/wallet.svg" alt=""><span>Кошелёк</span></a></li>



                <?php
                /*if(strtotime($user->goal_time)>(strtotime('now')-365*24*60*60*1000))
                {
                    ?>
                    <li><a href="/goals/step6"><img src="/images/target.svg" alt=""><span>Цели</span></a></li>
                <?php
                }
                else
                {
                    ?>
                    <li><a href="/goals/index"><img src="/images/target.svg" alt=""><span>Цели</span></a></li>
                <?php
                }*/
                ?>

                <!--<li><a href="/docs/index2"><img src="/images/google_docs2.svg" alt=""><span>Креативы</span></a></li>-->



                <li><a href="/support/index"><img src="/images/paper_plane.svg" alt=""><span>Поддержка</span></a></li>
                <li><a href="/faq/index"><img src="/images/faq.svg" alt=""><span>FAQ</span></a></li>

                <!--<li><a href="/docs/index"><img src="/images/google_docs.svg" alt=""><span>Документы</span></a></li>-->
                <li><a href="/user/profile"><img src="/images/gear.svg" alt=""><span>Профиль</span></a></li>

            </ul>
        </div>
        <a href="/site/logout" class="lp_exit"><img src="/images/exit.svg" alt=""><span>Выход</span></a>
    </div>

    <div class="main_content">
        <div class="top_panel">
            <ul class="tp_nav">

                <li><a style="text-decoration: none;" href="/notifications/index"><span>Уведомления <?php if($cnt=$user->notifications_unread_count)echo'('.$cnt.')';?></span><img src="/images/bell.png" alt=""></a></li>
                <li><a class="tp_profile" href="/money/wallet"><span><span><?php echo $user->name ?></span> <strong style="padding-left: 10px">ID: <?php echo Yii::$app->user->id ?></strong></span><i><img class="user" src="<?php echo $user->avatar_src?>" alt=""></i></a>
                    <div class="nav_popup">
                        <a href="/user/profile"><img src="/images/user.png" alt=""><span>Профиль</span></a>
                        <a class="np_exit" href="/site/index"><img src="/images/exit.png" alt=""><span>Выход</span></a>
                    </div>
                </li>
            </ul>
        </div>
            <?= $content ?>
    </div>
    <?php
    //if(Yii::$app->controller->id=='support')
    {
        ?>
        <a class="tg_link" href="https://t.me/libertytop_bot" target="_blank">
            <svg id="Bold" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path fill="#FFF" d="m9.417 15.181-.397 5.584c.568 0 .814-.244 1.109-.537l2.663-2.545 5.518 4.041c1.012.564 1.725.267 1.998-.931l3.622-16.972.001-.001c.321-1.496-.541-2.081-1.527-1.714l-21.29 8.151c-1.453.564-1.431 1.374-.247 1.741l5.443 1.693 12.643-7.911c.595-.394 1.136-.176.691.218z"/></svg>
        </a>
        <style>
            .tg_link{z-index:1;position: fixed;bottom: 20px;right:20px;width: 100px;height: 100px;display: block;border-radius: 50%;background: #64a9dc;cursor: pointer;padding: 30px}
            .tg_link svg{display: block;max-width: 100%;width: 100%;height: auto;}
        </style>
    <?php
    }
    ?>
</div>

<?php $this->endBody() ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(82269682, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/82269682" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>
