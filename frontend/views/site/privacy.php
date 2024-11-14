<?php

/* @var $this yii\web\View */

$this->title = 'Политика конфиденциальности';
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
                            <span></span><span></span><span></span>
                        </a>

                        <div class="user_nav_box">
                            <?php echo $this->render('//layouts/_left',['user'=>$user]);?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </header>

</main>



    <div class="about_block">
        <div class="container">
            <div class="about">
                <h4>Политика конфиденциальности </h4>

                <p align="center">
                    Ваша конфиденциальность очень важна для нас!</p>
                <p>
                    Доверие наших Пользователей имеет для нас первостепенное значение и поэтому мы стремимся защищать Ваше право на конфиденциальность. Мы хотим, чтобы Ваша работа и обучение на Сайте https://libertygame.ru, по возможности, были максимально приятными, продуктивными и полезными, и Вы совершенно спокойно использовали широчайший спектр услуг Сайта.</p>
                <p>
                    Мы разработали данную Политику конфиденциальности, чтобы продемонстрировать Пользователю свою верность принципам конфиденциальности и безопасности. В Политике конфиденциальности описано, как и для чего Администрация Сайта собирает информацию обо всех зарегистрированных Пользователях своих Интернет-услуг на Сайте. Политика конфиденциальности также включает объяснение о том, что мы делаем с собранной информацией, и какие возможности по сбору и использованию такой информации есть.</p>
                <p>
                    Мы просим Вас тщательно ознакомиться с Политикой конфиденциальности.</p>
                <p align="center">
                    <strong>1. Общие положения</strong></p>
                <p>
                    1.1. Настоящая Политика в отношении обработки персональных данных Пользователей разработана в соответствии с положениями Федерального закона от 27.07.2006 №152-ФЗ &laquo;О персональных данных&raquo; (с изменениями и дополнениями), другими законодательными и нормативными правовыми актами и определяет порядок работы с персональными данными Пользователей и (или) передаваемых Пользователями и требования к обеспечению их безопасности.</p>
                <p>
                    1.2. Под персональными данными понимается любая информация, относящаяся прямо или косвенно к определённому или определяемому физическому лицу (субъекту персональных данных) и которая может быть использована для идентификации определённого лица либо связи с ним.</p>
                <p>
                    1.3. Использование Пользователем Сайта https://libertygame.ruозначает согласие с настоящей Политикой конфиденциальности и условиями обработки персональных данных Пользователя.</p>
                <p>
                    1.4. В случае несогласия с условиями Политики конфиденциальности Пользователь должен прекратить использование сайта https://libertygame.ru.</p>
                <p>
                    1.5. Настоящая Политика конфиденциальности применяется только к сайту https://libertygame.ru. Сайт https://libertygame.ru не контролирует и не несёт ответственность за сайты третьих лиц, на которые Пользователь может перейти по ссылкам, доступным на сайте https://libertygame.ru.</p>
                <p>
                    1.6. &nbsp;Ваши персональные данные могут быть переданы нашим партнёрам, третьим лицам, в частности, курьерским службам, организациями почтовой связи, операторам электросвязи, платёжным агрегаторам и т.д., исключительно для целей, необходимых для оказания запрашиваемой Вами услуги и исполнения нами действующего законодательства РФ. Мы предоставляем третьим лицам минимальный объём персональных данных, необходимый только для оказания требуемой услуги или проведения необходимой транзакции.</p>
                <p>
                    1.7. Политика конфиденциальности является неотъемлемой частью Пользовательского соглашения.</p>
                <p align="center">
                    <strong>2. &nbsp;Предмет политики конфиденциальности</strong></p>
                <p>
                    2.1. &nbsp;Настоящая Политика конфиденциальности устанавливает обязательства Администрации сайта https://libertygame.ru по неразглашению и обеспечению режима защиты конфиденциальности персональных данных, которые Пользователь предоставляет по запросу Администрации сайта при регистрации на сайте https://libertygame.ru.</p>
                <p>
                    2.2. Персональные данные, разрешённые к обработке в рамках настоящей Политики конфиденциальности, Пользователи самостоятельно указывают на Сайте при регистрации Личного кабинета (E-mail, Телеграмм аккаунт), а также различную техническую информацию. С помощью логов сервера и других инструментов мы регистрируем данные о техническом устройстве, которым Вы пользуетесь, и каким образом это устройство подключается к нашим сервисам, включая данные об операционной системе, версии браузера, IP-адресах, файлах Cookies и уникальных идентификационных файлах. Обычно эти данные используются для получения анонимной (обезличенной) и совокупной статистики, но она также может быть связана с вашей учётной записью (профилем).</p>
                <p>
                    <u>Обработка персональных данных</u> - любое использование персональных данных, например, их сбор, регистрация, сопоставление, хранение и передача, или комбинация любых из этих действий. При обработке персональных данных мы руководствуемся Федеральным законом РФ &laquo;О персональных данных&raquo;.</p>
                <p>
                    2.3. Политика конфиденциальности призвана обеспечить и гарантировать информирование всех Пользователей и посетителей Сайта https://libertygame.ru&nbsp;о том, какие данные о Пользователях и посетителях собираются Сайтом, каким образом это происходит и в каких целях.</p>
                <p>
                    2.4. Данные, автоматически собираемые при использовании наших сервисов (данные технического характера об устройстве, IP-адресах, файлах cookies и уникальных идентификационных файлах, данные о местоположении).</p>
                <p align="center">
                    <strong>3. Цель сбора и использование данных</strong></p>
                <p>
                    3.1. При регистрации на Сайте мы просим Вас заполнить регистрационную форму и указать в ней некоторые Ваши персональные данные. Мы используем эту информацию для дальнейшей связи с Вами.</p>
                <p>
                    3.2. Целью сбора персональных и информационных данных является качественное предоставление Вам наших информационных услуг, которые Вы запросили на Сайте. Мы не будем использовать Ваши персональные и информационные данные в целях, которые не связаны с нашим Сервисом.</p>
                <p>
                    3.4. Когда Вы пользуетесь Сайтом и/или его информационными услугами мы собираем информацию о тех страницах, которые Вы посетили, времени посещения https://libertygame.ru, а также информацию о вашем браузере. Мы также используем различные технические опции, чтобы идентифицировать Вас как Пользователя и проанализировать полученную информацию о наших Пользователях. Методы (в том числе файлы Cookies), которые мы применяем в этих целях, необходимы для того, чтобы наши сервисы работали должным образом, чтобы Вам было проще пользоваться нашими сервисами, а также, чтобы мы смогли проводить исследования, которые бы в будущем способствовали усовершенствованию наших сервисов в соответствии с потребностями Пользователей.</p>
                <p>
                    3.5. Собираемые нами персональные данные позволяют направлять Вам уведомления о новых продуктах, услугах, программах, специальных предложениях. Они также помогают нам улучшать наши информационные услуги, Контент и коммуникации. Если Вы не желаете быть включённым в наш список рассылки, Вы можете в любое время отказаться от рассылки, кликнув на ссылку &laquo;отказаться от рассылки&raquo;, которая будет размещена информационном письме.</p>
                <p>
                    3.6. Если сбор такой информации через маркеры Cookies Вам неприятен, рекомендуем отключить эти функции в настройках своего браузера, но, пожалуйста, помните, что это ограничит эффективность и функциональность веб-сайта. О том, как отключить поддержку Cookies и маяков, как правило, говорится в инструкции к браузеру.</p>
                <p align="center">
                    <strong>4. Способы и сроки обработки персональной информации</strong></p>
                <p>
                    4.1. Обработка персональных данных Пользователя осуществляется без ограничения срока, любым законным способом, в том числе в информационных системах персональных данных с использованием средств автоматизации или без использования таких средств.</p>
                <p>
                    4.2. Обработка персональных данных Пользователя осуществляется при наличии согласия Пользователя на обработку его персональных данных. Согласие дается путём принятия Пользовательского соглашения.</p>
                <p>
                    4.3. Ваши персональные данные об использовании наших сервисов могут быть переданы другим аффилированным к нам компаниям, компаниям-партнёрам для использования в тех целях, для которых эта информация была собрана. По возможности информация будет предоставлена в анонимной (обезличенной) форме, однако в некоторых случаях такая информация может допускать Вашу идентификацию.</p>
                <p>
                    4.4. Персональные данные Пользователя могут быть переданы уполномоченным органам государственной власти Российской Федерации только по основаниям и в порядке, установленным законодательством Российской Федерации.</p>
                <p>
                    4.5. Администрация Сайта принимает необходимые организационные и технические меры для защиты персональной информации Пользователя от неправомерного или случайного доступа, уничтожения, изменения, блокирования, копирования, распространения, а также от иных неправомерных действий третьих лиц.</p>
                <p>
                    4.6. Администрация Сайта совместно с Пользователем принимает все необходимые меры по предотвращению убытков или иных отрицательных последствий, вызванных утратой или разглашением персональных данных Пользователя.</p>
                <p align="center">
                    <strong>5. Обязанности сторон</strong></p>
                <p>
                    5.1. Пользователь обязан:</p>
                <p>
                    5.1.1. Предоставить информацию о персональных данных, необходимую для пользования Сайтом.</p>
                <p>
                    5.1.2. Обновить, дополнить предоставленную информацию о персональных данных в случае изменения данной информации.</p>
                <p>
                    5.2. Администрация сайта обязана:</p>
                <p>
                    5.2.1. Использовать полученную информацию исключительно для целей, указанных в п. 3 настоящей Политики конфиденциальности.</p>
                <p>
                    5.2.2. Обеспечить хранение конфиденциальной информации в тайне, не разглашать без предварительного письменного разрешения Пользователя, а также не осуществлять продажу, обмен, опубликование, либо разглашение иными возможными способами переданных персональных данных Пользователя, за исключением п.п. 4.2. и 4.3. настоящей Политики конфиденциальности.</p>
                <p>
                    5.2.3. Принимать меры предосторожности для защиты конфиденциальности персональных данных Пользователя согласно порядку, обычно используемого для защиты такого рода информации в существующем деловом обороте.</p>
                <p>
                    5.2.4. Осуществить блокирование персональных данных, относящихся к соответствующему Пользователю, с момента обращения или запроса Пользователя или его законного представителя либо уполномоченного органа по защите прав субъектов персональных данных на период проверки, в случае выявления недостоверных персональных данных или неправомерных действий.</p>
                <p align="center">
                    <strong>6. Дополнительные условия</strong></p>
                <p>
                    6.1. Администрация сайта вправе вносить изменения в настоящую Политику конфиденциальности без согласия Пользователя.</p>
                <p>
                    6.2. Новая Политика конфиденциальности вступает в силу с момента её размещения на Сайте, если иное не предусмотрено новой редакцией Политики конфиденциальности.</p>
                <p>
                    6.3. Действующая Политика конфиденциальности размещена на странице по адресу https://libertygame.ru/policy</p>
                <p>
                    6.4. К настоящей Политике конфиденциальности и отношениям между Пользователем и Администрацией сайта применяется действующее законодательство Российской Федерации.</p>
                <p>
                    <br />
                    &nbsp;</p>
                <p>
                    &nbsp;</p>

            </div>
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

<style>
    .about a{display:inline}
</style>