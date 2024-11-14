<?php

/* @var $this yii\web\View */

$this->title = 'libertygame';
use yii;
use yii\widgets\ActiveForm;


?>
<main style="margin-top: 50px">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="/game/img/logo.png" alt=""></a>
        </div>
        <div class="get_link" style="margin-top: 80px">
            <div class="title">
                <h3>Вы успешно подтвердили Email</h3>

            </div>

            <div class="get_link_res" style="display:block;">
<!--                <p>--><?php //echo $user->getReferal_link()?><!-- <a id="link" class="copy_btn" href="javascript:void(0)"></a></p>-->
<!--                <div style="margin-top: 40px;display: block;text-align: center"><div class="ya-share2" data-size="l" data-url="--><?php //echo $user->getReferal_link()?><!--" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div></div>-->
<!--                <script src="https://yastatic.net/share2/share.js" async></script>-->
            </div>
            <h2 style="text-align: center;margin-top: 20px">Наш <a style="text-decoration: underline;color: var(--m)" target="_blank" href="https://t.me/LibertyGameofficial">телеграмм канал</a></h2>

            <div style="display: block;margin: 40px auto 0;text-align: center"><a class="btn" href="/">Перейти на главную</a></div>
        </div>
    </div>
</main>






<footer>
    <div class="container">
        <div class="footer">
<!--            <p><a href="javascript:void(0)">Политика обработки персональных данных</a></p>-->
<!--            <p><a href="javascript:void(0)">Пользовательское соглашение</a></p>-->
            <p class="copyright">© Liberty Game Ltd, <?php echo date('Y')?></p>
        </div>
    </div>
</footer>