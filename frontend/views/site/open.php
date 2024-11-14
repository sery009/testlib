<?php

use common\models\Open;

$this->title='Впервые в Казани!';
?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(89237222, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/89237222" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(89237392, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/89237392" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<main style="margin-top: 50px">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="/game/img/logo.png" alt=""></a>
        </div>


    </div>
</main>

<div class="video_block">
    <div class="container">
        <div class="video">
            <div class="title">
                <h3>Впервые в Казани!<br>22 июня в 19:00 по МСК<br>Место проведения  встречи тебе пришлют в Whats app<br>
                    <span style="color: var(--m)">Осталось мест:<br> 27/100</span>
                </h3>
            </div>
            <div class="video_box">
                <iframe src="https://player.vimeo.com/video/718672966" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <img src="https://i.vimeocdn.com/video/1440519900-1ed64e863a5bdccc920bfbc297ba222da8b5d35a2629d42914fd601615a42902-d?mw=1300&mh=731"
                     alt="" class="" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;z-index: 0">
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </div>
</div>
<p style="text-align: center;margin-top: 40px;font-weight: bold">
    Не хватает мотивации? <br><span style="color: var(--m)">Приходи!</span><br>
    Не знаешь, как достичь цели? <br><span style="color: var(--m)">Приходи!</span><br>
    Не хватает денег? <br><span style="color: var(--m)">Приходи!</span><br>
    Не хватает знаний? <br><span style="color: var(--m)">Приходи!</span><br>
    Устал жить с родителями? <br><span style="color: var(--m)">Приходи!</span><br>
    Надоело ездить на метро? <br><span style="color: var(--m)">Приходи!</span><br>
    Не нашёл себя в жизни? <br><span style="color: var(--m)">Приходи!</span><br>
    Нужна интересная работа? <br><span style="color: var(--m)">Приходи!</span><br>
    Нечем платить кредит? <br><span style="color: var(--m)">Приходи!</span><br>
    Не знаешь, что делать? <br><span style="color: var(--m)">Приходи!</span><br>

</p>
<p style="text-align: center;margin-top: 20px"><span>Приходи и узнай,<br> как сделать<br> из <b>1&nbsp;000&nbsp;руб. - 1&nbsp;млн.&nbsp;руб.</b></span></p>
    <div class="get_link">

        <div class="main_col">
            <?php
            if(isset($_POST['fio']))
            {
                /*header("Content-Type: text/html; charset=utf-8");
                require $_SERVER['DOCUMENT_ROOT']."/core/phpmailer/PHPMailerAutoload.php";

                $email='ФИО: '.$_POST['fio'].'<br>';
                $email.='Телефон: '.$_POST['phone'].'<br>';
                $email.='Достижения: '.$_POST['regalii'].'<br>';
                $email.='Цель: '.$_POST['goals'].'<br>';

                $mail = new PHPMailer();
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Заявка на презентацию нового проекта';
                $mail->addAddress('libertygame1@yandex.ru');

                $mail->setFrom('info@gameliberty.ru',"gameliberty");
                $mail->msgHTML($email);
                $m = $mail->send();*/
                $message='Заявка на мероприятие ';
                $message.="\r\nПользователь ".$_POST['fio'].' '.$_POST['phone'];
                if($id!='open')
                $message.="\r\nСсылка https://libertygame.ru/promo/".$id;
                //file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-778936755');

                $a=new Open();
                $a->date=date('Y-m-d H:i:s');
                $a->page=$id;
                $a->type='call';
                $a->name=$_POST['fio'];
                $a->phone=$_POST['phone'];
                $a->save();

                //-778936755
                echo'<p style="text-align: center;color: var(--m);">Оставайся на связи, с Вами в ближайшее время свяжется наш менеджер и сообщит место встречи</div>';

            }
            else
            {
                ?>
                <form action="" method="post" class="reg_form">
                    <input required type="text" name="fio" id="Login_reg" placeholder="Фамилия, Имя, Отчество">
                    <input required type="text" name="phone" id="Phone" placeholder="+7 (999) 999-99-99">


                    <button class="btn" style="background: var(--m);box-shadow: none;height: 80px">Зарегистрироваться бесплатно</button>

                </form>
            <?php }?>
        </div>
    </div>




<footer>
    <div class="container">
        <div class="footer">
            <!--            <p><a href="javascript:void(0)">Политика обработки персональных данных</a></p>-->
            <!--            <p><a href="javascript:void(0)">Пользовательское соглашение</a></p>-->
            <p class="copyright">© Liberty Game Ltd, <?php echo date('Y')?></p>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/imask"></script>

<script>
    var element = document.getElementById('Phone');
    var maskOptions = {
        mask: '+{7} (000) 000-00-00'
    };
    var mask = IMask(element, maskOptions);


</script>
