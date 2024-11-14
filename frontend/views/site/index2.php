<?php

/* @var $this yii\web\View */

$this->title = 'libertygame';
use yii;
use yii\widgets\ActiveForm;


?>
<main>
    <?php if(!\Yii::$app->user->isGuest){?>
    <?php echo $this->render('//layouts/_left',['user'=>$user]);?>

    <div class="mobile_toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <?php }?>
    <header>
        <div class="container">
            <div class="header">
                <?php if(\Yii::$app->user->isGuest){?>
                <div class="h_links">
                    <a href="<?php echo yii\helpers\Url::to(['site/login'])?>" class="login">Вход</a>
                    <a href="<?php echo yii\helpers\Url::to(['site/registration'])?>">Регистрация</a>
                </div>
                <?php }else{?>
                <div class="user_nav">
                    <a href="" class="mobile_toggle">
                        <!--                        Личный кабинет-->
                        <span></span><span></span><span></span>
                    </a>

                    <div class="user_nav_box">
<!--                        <ul>-->
<!--                            <li><a href="--><?php //echo \yii\helpers\Url::to(['learn/index'])?><!--" class="wi education_icon">Обучение</a></li>-->
<!--                            <li><a href="--><?php //echo \yii\helpers\Url::to(['referals/index'])?><!--" class="wi referals_icon">Рефералы</a></li>-->
<!--                            <li><a href="--><?php //echo \yii\helpers\Url::to(['rounds/index'])?><!--" class="wi rounds_icon">Раунды</a></li>-->
<!--                            <li><a href="--><?php //echo \yii\helpers\Url::to(['wallet/index'])?><!--" class="wi wallet_icon">Кошелек</a></li>-->
<!--                            <li><a href="--><?php //echo \yii\helpers\Url::to(['top/index'])?><!--" class="wi top_icon">Топ участников</a></li>-->
<!--                            <li><a href="--><?php //echo yii\helpers\Url::to(['site/logout'])?><!--" class="lwi quit_icon">Выйти</a></li>-->
<!--                        </ul>-->
                        <?php echo $this->render('//layouts/_left',['user'=>$user]);?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="logo">
            <a href="/"><img src="/game/img/logo.png" alt=""></a>

            <h3>‼️ ВНИМАНИЕ ‼️</h3>
            <h3>ПРЯМОЙ ЭФИР
<br>
                В четверг 14.11.24<br>
                в 19:00 по МСК<br>

                в телеграм канале</h3>



            <p><a class="btn" style="max-width:100%;display: flex;margin-top: 30px" href="https://t.me/LibertyGameofficial">Подписаться на телеграм канал</a></p>
            <h3>Образовательная программа</h3>
            <p>с элементами игры и гибридным алгоритмом распределения средств</p>
        </div>
        <div class="counter_box">
            <h3>До начала игры:</h3>
            <div class="counter bs">
                <div class="counter_item">
                    <p id="days">0</p>
                    <span data-text="дней">дней</span>
                </div>
                <div class="counter_item">
                    <p id="hours">0</p>
                    <span data-text="часов">часов</span>
                </div>
                <div class="counter_item">
                    <p id="minutes">0</p>
                    <span data-text="минут">минут</span>
                </div>
                <div class="counter_item">
                    <p id="seconds">0</p>
                    <span data-text="секунд">секунд</span>
                </div>
            </div>
        </div>
    </div>
</main>


<div class="video_block">
    <div class="container">
        <div class="video">
            <div class="video_box">
               <iframe src="https://player.vimeo.com/video/715971820?h=a72eb2a125&title=0&byline=0&portrait=0"  frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <img src="https://i.vimeocdn.com/video/1440519900-1ed64e863a5bdccc920bfbc297ba222da8b5d35a2629d42914fd601615a42902-d?mw=1300&mh=731"
                     alt="" class="" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;z-index: 0">
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>

<?php if(\Yii::$app->user->isGuest){?>
    <a href="<?php echo yii\helpers\Url::to(['site/login'])?>" class="btn">войти</a>
                <?php }?>

        </div>
    </div>
</div>
<?php if(\Yii::$app->user->isGuest){?>
    <div class="about_block">
        <div class="container">
            <div class="about">
                <h4>О Liberty Game</h4>
                <p>Образовательная программа состоит из 64-х видеоуроков длительностью от 3-х до 7-ми минут,
                    представляющих собой четкие инструкции, готовые к применению в повседневной жизни.</p>
                <p>Никакой «воды», только полезная информация, «упакованная» профессиональными видеографами с
                    применением инфографики и самых современных технологий видеопроизводства, что позволяет
                    получать её в удобном и понятном для участников формате.</p>

<!--                <a href="" class="more_info"></a>-->
            </div>
        </div>
    </div>
    <?php echo $this->render('//site/_stat');?>
    <?php echo $this->render('//site/_stat2');?>
<?php }else{
    ?>
    <?php echo $this->render('//site/_stat');?>

    <?php
}
?>

<footer>
    <div class="container">
        <div class="footer">
<!--            <p><a href="javascript:void(0)">Политика обработки персональных данных</a></p>-->
<!--            <p><a href="javascript:void(0)">Пользовательское соглашение</a></p>-->
            <p class="copyright" style="margin-top: 0">© Liberty Game Ltd, <?php echo date('Y')?></p>
        </div>
    </div>
</footer>