<?php

/* @var $this yii\web\View */

$this->title = 'libertygame';
use yii;
use yii\widgets\ActiveForm;


?>
<main style="margin-top: 50px">
    <div class="container">
        <div class="logo">
            <a href=""><img src="/game/img/logo.png" alt=""></a>
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
        <div class="rating" style="margin-top: 40px;text-align: center">
            <p style="color: var(--m)">Зарегистрировано</p>
            <h3><?php echo \common\models\User::find()->where(1)->count()+345;?></h3>
            <p style="color: var(--m)">человек</p>
        </div>
    </div>
</main>
<div class="video_block">
    <div class="container">
        <div class="video">
            <div class="title">
                <h3>Посмотри видео,</h3>
                <p>прежде чем сделать следующий шаг</p>
            </div>
            <div class="video_box">
<!--                <iframe width="560" height="315" src="https://www.youtube.com/embed/msywAMv8AdY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                <iframe src="https://player.vimeo.com/video/715971820?h=6da2c3fcb2" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <img src="https://i.vimeocdn.com/video/1440519900-1ed64e863a5bdccc920bfbc297ba222da8b5d35a2629d42914fd601615a42902-d?mw=1300&mh=731"
                     alt="" class="" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;z-index: 0;">
                <!--                <img src="img/video.jpg" alt="">-->
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </div>
</div>

<div class="get_link_block" style="display: none">
    <div class="container">
        <div class="get_link">
            <div class="title">
                <h3>Получи ссылку</h3>
                <p>для отправки друзьям</p>
            </div>
            <form action="" class="get_link_form">
                <input type="hidden" name="login" value="0" class="hidden_login" autocomplete="off">
                <input name="id"  type="hidden" value="<?php echo $_GET['nick']?>" >
                <input name="email" class="bs" type="text" placeholder="Почта*" >
                <input name="nick" class="bs" type="text" placeholder="Никнейм*" >
                <input name="telegram" class="bs" type="text" placeholder="@telegram" >
                <button class="btn">получить ссылку</button>

            </form>
            <div class="get_link_res">
                <!--<p>https://libertygame.ru/skdfjBxKSh235 <a href="" class="copy_btn"></a></p>-->
            </div>
            <p class="remember"><a href="javascript:void(0)">У меня уже есть ссылка. Напомните</a></p>
            <h2 style="text-align: center;margin-top: 20px">Обязательное условие, быть подписанным<br> на наш <a style="text-decoration: underline;color: var(--m)" target="_blank" href="https://t.me/libertygameofficialch">телеграмм канал</a></h2>
        </div>
    </div>
</div>

<div class="rating_block"  style="display: none">
    <div class="container">
        <div class="rating">
            <div class="title">
                <h3>Рейтинг игроков</h3>
                <p>Призовой фонд: 220 000 ₽</p>
            </div>
            <div class="rating_box bs">
                <div class="rating_box_header">
                    <p>Место</p>
                    <p>Никнейм</p>
                    <p>Пригласил</p>
                    <p>Приз</p>
                </div>
                <div class="to">
                    <div class="rating_box_body scrollbar-inner">
                        <?php

                        $users=\common\models\User::find()->where(['status'=>\common\models\User::STATUS_ACTIVE])->andWhere(['>','register_count',0])->orderBy(['register_count'=>SORT_DESC])->limit(100)->all();
                        if($users)
                        {
                            $k=0;
                            foreach ($users as $u)
                            {

                                    $k++;
                                ?>
                                <div class="rating_body_line" data-nick="<?php echo mb_strtolower(trim($u->nick))?>" data-place="<?php echo $k?>" data-cnt="<?php echo $u->register_count?>" data-prize="<?php echo \common\models\Config::places($k);?>">
                                    <p><?php echo $k?></p>
                                    <p><?php echo $u->nick?></p>
                                    <p><?php echo $u->register_count?></p>
                                    <p><?php echo \common\models\Config::places($k);?> ₽</p>
                                </div>
                        <?php

                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="self_res_block"  style="display: none">
    <div class="container">
        <div class="self_res">
            <h4>Узнай свою позицию</h4>
            <form action="" class="check_position">
                <input type="text" class="bs" placeholder="Your Nickname">
                <button></button>
            </form>
            <div class="self_res_item">
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer">
<!--            <p><a href="javascript:void(0)">Политика обработки персональных данных</a></p>-->
<!--            <p><a href="javascript:void(0)">Пользовательское соглашение</a></p>-->
            <p style="margin-top: 0" class="copyright">© Liberty Game Ltd, <?php echo date('Y')?></p>
        </div>
    </div>
</footer>