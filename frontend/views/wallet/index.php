<?php
$this->title='Баланс';?>

<div class="main_box">
    <div class="pay">
        <h1 class="pay__heading">
            Баланс
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.97 24.97">
                <path d="M31.42,7.4V4.68A4.67,4.67,0,0,0,26.75,0H4.67A4.68,4.68,0,0,0,0,4.67H0V20.29A4.68,4.68,0,0,0,4.67,25H26.75a4.66,4.66,0,0,0,4.67-4.68v-4A2.66,2.66,0,0,0,33,13.86v-4A2.66,2.66,0,0,0,31.42,7.4Zm-1.5,6.06H25.19a1.62,1.62,0,0,1,0-3.24h4.73ZM3.05,20.29V4.68A1.62,1.62,0,0,1,4.67,3.05h.67V21.91H4.67a1.62,1.62,0,0,1-1.62-1.62Zm23.7,1.62H8.4V3.05H26.75a1.62,1.62,0,0,1,1.62,1.63V7.15H25.19a4.69,4.69,0,0,0-4.67,4.69h0a4.68,4.68,0,0,0,4.67,4.68h3.18v3.77a1.62,1.62,0,0,1-1.62,1.62Z" />
            </svg>
        </h1>
        <?php
        if($rt=\common\models\RoubleTransactions::find()->where(['user_id'=>$user->id,'status'=>'not started'])->andWhere(['>','date',date('Y-m-d H:i:s',strtotime('-10 minutes'))])->one())
        {
            //var_dump(\common\models\RoubleTransactions::find()->where(['user_id'=>$user->id,'status'=>'not started'])->andWhere(['>','date',strtotime('-10 minutes')])->createCommand()->rawSql);
        ?>
        <a class="pay__history-nav-btn active" style="margin: 0 0 30px" href="<?php echo $rt->link?>">Закончить оплату</a>
        <?php
        }
        ?>
        <div class="pay__tabs-wrapper js-tabs">


            <div class="pay__top-row">
                <div class="pay__balance">
                    <div class="pay__balance-amount">
                        <?php echo number_format($user->balance,0,'',' ')?> ₽
                    </div>
                    <h2 class="pay__balance-heading">
                        Текущий баланс
                    </h2>
                </div>
                <div class="pay__balance gr">
                    <div class="pay__balance-amount">
                        <?php echo number_format(\common\models\Reports::find()->where(['hold'=>1,'to'=>$user->id])->sum('sum_rub'),0,'',' ')?> ₽
                    </div>
                    <h2 class="pay__balance-heading">
                        Холд
                    </h2>
                </div>
                <div class="pay__nav">
                    <a href="#" class="pay__nav-btn js-tabs-btn">
                        Пополнить
                    </a>
                    <a href="#" class="pay__nav-btn js-tabs-btn">
                        Вывести
                    </a>
                    <a href="#" class="pay__nav-btn js-tabs-btn">
                        Перевести
                    </a>
                </div>
            </div>
            <div class="pay__tabs">
                <div class="pay__tab js-tabs-item">
                    <div class="pay__block">
                        <h3 class="pay__block-heading">
                            Создание заявки на пополнение
                        </h3>
                        <div class="pay__block-enter-sum">
                            <h4 class="pay__block-enter-sum-title">
                                Введите сумму пополнения в рублях
                            </h4>
                            <div class="pay__block-enter-sum-input-wrapper">
                                <input type="tel" class="pay__block-enter-sum-input js-numeric-input-decimals sum_add" required value="0" data-kurs="<?php echo \common\models\Config::getRateForIncome();?>">
                            </div>
                            <h4 class="pay__block-enter-sum-title">
                                Минимальная сумма 1000 руб
                            </h4>
                        </div>
                        <div class="pay__block-converted">
                            <h4 class="pay__block-converted-heading">
                                Сумма пополнения в USDT составит:
                            </h4>
                            <div class="pay__block-converted-amount">
                                <span class="sum_add_usdt">0 USDT</span>
                            </div>
                        </div>
                        <div class="pay__block-method">
                            <h4 class="pay__block-method-heading">
                                Выберите способ оплаты:
                            </h4>
                            <div class="pay__block-method-btns">
                                <a href="#" class="pay__block-method-btn js-pay-usdt-btn pay_usdt  js-pay-usdt-btn">
                                    Оплатить в USDT (TRC20)
                                </a>
                                <a href="#" class="pay__block-method-btn pay_rouble js-pay-ruble-btn">
                                    Оплатить в рублях
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="pay__block js-pay-usdt-block hidden">
                        <div class="pay__block-next-step">


                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.04 32.03">

                                <path fill="#272928" d="M22.71,14.2,16,20.89,9.34,14.2l1.74-1.75,5,4.94L21,12.45ZM16,0A16,16,0,1,0,32,16h0A16,16,0,0,0,16,0Zm0,29.55A13.54,13.54,0,1,1,29.56,16h0A13.56,13.56,0,0,1,16,29.55Z" />
                            </svg>
                        </div>
                        <h3 class="pay__block-heading">
                            Оплата заявки на пополнение
                        </h3>
                        <div class="pay__block-timer">
                            <div class="pay__block-timer-text" style="color: yellow;max-width: 600px">
                                Внимание! Сумма перевода должна точно соответствовать указаной ниже и быть перечислена одним платежом. В случае отправки другой суммы на указанный кошелёк, ваш перевод не будет принят, а денежные средства будут потеряны. При этом мы не сможем их вам вернуть или зачислить на баланс в системе. Будьте внимательны при совершении перевода!
                            </div>
                            <div class="pay__block-timer-text" style="margin-top: 30px">
                                Внимание! Средства необходимо внести в течение 30 минут
                            </div>
                            <div class="pay__block-timer-countdown js-countdown" style="margin-top: 30px">
                                30:00
                            </div>

                        </div>
<!--                        <div class="pay__block-you-get">-->
<!--                            <h4 class="pay__block-you-get-heading">-->
<!--                                Вы получаете на баланс:-->
<!--                            </h4>-->
<!--                            <div class="pay__block-you-get-amount">-->
<!--                                <span class="add_sum_copy"></span> ₽-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="pay__block-copy-links">
                            <div class="pay__block-copy-links-item">
                                <div class="pay__block-copy-links-item-text">
                                    Необходимо отправить:
                                    <span style="display: inline-flex">
                                        <b class="sum_add_usdt" style="font-size: 18px">0 USDT</b>
                                        <a href="#" class="pay__block-copy-link js-copy-link sum_copy_text" data-copy-text="" style="padding-left: 10px">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.04 23.97">
                                                <path d="M18.22,0H7.66A3.83,3.83,0,0,0,4.05,2.66H6.62a1.54,1.54,0,0,1,1-.4H18.22a1.65,1.65,0,0,1,1.61,1.66V15.18a1.65,1.65,0,0,1-.68,1.34V11.29A3.24,3.24,0,0,0,18.25,9L14.11,4.76a3,3,0,0,0-2.19-.93H3.8A3.87,3.87,0,0,0,0,7.76V20A3.87,3.87,0,0,0,3.8,24H15.35A3.87,3.87,0,0,0,19.15,20V19A3.92,3.92,0,0,0,22,15.18V3.92A3.87,3.87,0,0,0,18.22,0ZM17,20a1.63,1.63,0,0,1-1.6,1.65H3.8A1.63,1.63,0,0,1,2.2,20V7.76A1.64,1.64,0,0,1,3.8,6.1h8.12a.9.9,0,0,1,.45.13c0,.52,0,1.15,0,1.76a2.47,2.47,0,0,0,2.39,2.56h1.85l.1.1a.9.9,0,0,1,.26.64Z" />
                                            </svg>
                                        </a>
                                    </span>

                                </div>

                            </div>
                            <div class="pay__block-actions" style="margin-bottom: 0">
                                <div class="pay__block-actions-text">
                                    <p>
                                        Средства  в размере <b class="sum_to_get">0</b>  будут зачислены на ваш баланс<br> после поступления средств на наш кошелек USDT (TRC20)
                                    </p>
                                </div>
                            </div>
                            <div class="pay__block-copy-links-item">
                                <div class="pay__block-copy-links-item-text">
                                    <span style="display: inline-flex;align-items: center">
                                        <b>
                                            <?php echo $user->getUsdtWallet();?>
                                        </b>
                                        <a href="#" class="pay__block-copy-link js-copy-link" data-copy-text="<?php echo $user->getUsdtWallet();?>" style="padding-left: 10px">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.04 23.97">
                                                <path d="M18.22,0H7.66A3.83,3.83,0,0,0,4.05,2.66H6.62a1.54,1.54,0,0,1,1-.4H18.22a1.65,1.65,0,0,1,1.61,1.66V15.18a1.65,1.65,0,0,1-.68,1.34V11.29A3.24,3.24,0,0,0,18.25,9L14.11,4.76a3,3,0,0,0-2.19-.93H3.8A3.87,3.87,0,0,0,0,7.76V20A3.87,3.87,0,0,0,3.8,24H15.35A3.87,3.87,0,0,0,19.15,20V19A3.92,3.92,0,0,0,22,15.18V3.92A3.87,3.87,0,0,0,18.22,0ZM17,20a1.63,1.63,0,0,1-1.6,1.65H3.8A1.63,1.63,0,0,1,2.2,20V7.76A1.64,1.64,0,0,1,3.8,6.1h8.12a.9.9,0,0,1,.45.13c0,.52,0,1.15,0,1.76a2.47,2.47,0,0,0,2.39,2.56h1.85l.1.1a.9.9,0,0,1,.26.64Z" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="pay__block-actions">
                            <div class="pay__block-actions-text">
                                <p>
                                    После отправки средств обязательно нажмите кнопку:
                                </p>
                            </div>
                            <div class="pay__block-actions-links">
                                <a href="javascript:void(0)" class="reload pay__block-actions-link pay__block-actions-link--filled confirm_payment_usdt">
                                    Я отправил
                                </a>
                                <a href="javascript:void(0)" class="pay__block-actions-link reload cancel">
                                    Отменить
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pay__block js-pay-ruble-block hidden">
                        <div class="pay__block-next-step">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.04 32.03">
                                <path fill="#272928" d="M22.71,14.2,16,20.89,9.34,14.2l1.74-1.75,5,4.94L21,12.45ZM16,0A16,16,0,1,0,32,16h0A16,16,0,0,0,16,0Zm0,29.55A13.54,13.54,0,1,1,29.56,16h0A13.56,13.56,0,0,1,16,29.55Z" />
                            </svg>
                        </div>
                        <div class="rubble_pay_box">
                            <div class="ruble_pay_cards">
<!--                                <h2 style="text-align: center">Сумма к оплате: <span class="pay_sum">1075</span> </h2>-->
                                <h2 style="text-align: center">‼️ ВНИМАНИЕ ‼️<br>
                                    ВНИМАТЕЛЬНО УКАЗЫВАЙТЕ СУММУ КОТОРАЯ УКАЗАНА В ПЛАТЕЖЕ. СУММА В ОТПРАВКЕ МОЖЕТ МЕНЯТЬСЯ В ЗАВИСИМОСТИ ОТ НАГРУЗКИ СИСТЕМЫ.
                                <br>
                                    ‼️В СЛУЧАЕ ОТПРАВКИ НЕВЕРНОЙ СУММЫ СРЕДСТВА БУДУТ УТЕРЯНЫ‼️
                                </h2>
                                <br>
                                <br>
                                <div class="ruble_pay_card_item" data-value="" style="margin: auto">
                                    Оплатить
                                </div>
                                <?php if(false){?>
                                <p>Выберите банк, на который удобнее сделать перевод:</p>
                                <div class="ruble_pay_cards_list" style="justify-content: center">
                                    <div class="ruble_pay_card_item" data-class="sber_card" data-value="sberbank">
                                        <img src="/lc/img/sber_logo.png" alt="">
                                    </div>
<!--                                    <div class="ruble_pay_card_item" data-class="alfa_card" data-value="alfa">
                                        <img src="/lc/img/alfa_logo.png" alt="">
                                    </div>
                                    <div class="ruble_pay_card_item" data-class="vtb_card" data-value="vtb">
                                        <img src="/lc/img/vtb_logo.png" alt="">
                                   </div>-->
                                    <div class="ruble_pay_card_item" data-class="tinkoff_card" data-value="tinkoff">
                                        <img src="/lc/img/tinkoff_logo.png" alt="">
                                    </div>
                                    <div class="ruble_pay_card_item" data-class="raif_card" data-value="raiffeisenbank">
                                        <img src="/lc/img/raif_logo.png" alt="">
                                    </div>
                                    <div class="ruble_pay_card_item" data-value="otkritie">
                                        Другие банки
                                    </div>
                                </div>
                                <?php }?>
                            </div>


                            <div class="card_info" style="display:none;">
                                <img src="/lc/img/loader.svg"  style="margin: 0 auto">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="pay__tab js-tabs-item">
                    <form class="pay__block moneyrequest_form"  method="POST" action="<?php echo \yii\helpers\Url::to(['wallet/request'])?>">
                        <h3 class="pay__block-heading">
                            Создание заявки на вывод
                        </h3>
                        <div class="pay__block-enter-sum">
                            <h4 class="pay__block-enter-sum-title">
                                Введите сумму вывода в рублях
                            </h4>
                            <div class="pay__block-enter-sum-input-wrapper">
                                <input type="tel" class="pay__block-enter-sum-input js-numeric-input-decimals sum_request" name="sum_rub" value="0" data-kurs="<?php echo \common\models\Config::getRateForOutcome();?>" required="required">
                            </div>
                            <h4 class="pay__block-enter-sum-title">
                                Минимальная сумма 1080 руб
                            </h4>
                        </div>
                        <div class="pay__block-method">
                            <input type="hidden" name="type" value="" class="moneyrequest_type">
                            <h4 class="pay__block-method-heading">
                                Выберите способ выплаты:
                            </h4>
                            <div class="pay__block-method-btns">
                                <a href="#" class="pay__block-method-btn moneyrequest_usdt_btn">
                                    На USDT кошелек (TRC20)
                                </a>
                                <a href="#" class="pay__block-method-btn moneyrequest_rub_btn">
                                    На банковскую карту (рубли)
                                </a>
                            </div>
                        </div>
                        <div class="pay__block  moneyrequest_usdt hidden"  style="margin-top: 40px">
                            <div class="pay__block-converted">
                                <h4 class="pay__block-converted-heading">
                                    Сумма вывода в USDT составит:
                                </h4>
                                <div class="pay__block-converted-amount">
                                    <span class="sum_request_usdt">0</span> USDT
                                </div>
                            </div>
                            <div class="pay__block-enter-sum pay__block-enter-sum--stretch">
                                <h4 class="pay__block-enter-sum-title">
                                    Укажите ваш кошелек для получения USDT:<br>
                                    кошелёк обязательно должен находится в сети TRC-20.
                                </h4>
                                <div class="pay__block-enter-sum-input-wrapper pay__block-enter-sum-input-wrapper--large">
                                    <input type="text" class="pay__block-enter-sum-input pay__block-enter-sum-input--blue pay__block-enter-sum-input--small-text" value=""  name="address">
                                </div>
                            </div>
                        </div>
                        <div class="pay__block  moneyrequest_rub hidden"  style="margin-top: 40px">
                            <div class="pay__block-converted">
                                <h4 class="pay__block-converted-heading">
                                    Сумма вывода в рублях составит:
                                </h4>
                                <div class="pay__block-converted-amount">
                                    <span class="sum_request_rub">0</span> руб
                                </div>
                            </div>
                            <div class="pay__block-enter-sum pay__block-enter-sum--stretch">
                                <h4 class="pay__block-enter-sum-title">
                                    Укажите номер Вашей банковской карты
                                </h4>
                                <div class="pay__block-enter-sum-input-wrapper pay__block-enter-sum-input-wrapper--large">
                                    <input type="text" class="pay__block-enter-sum-input pay__block-enter-sum-input--blue pay__block-enter-sum-input--small-text" value=""  name="address2">
                                </div>
                            </div>
                            <div class="pay__block-enter-sum pay__block-enter-sum--stretch">
                                <h4 class="pay__block-enter-sum-title">
                                    Имя фамилия
                                </h4>
                                <div class="pay__block-enter-sum-input-wrapper pay__block-enter-sum-input-wrapper--large">
                                    <input type="text" class="pay__block-enter-sum-input pay__block-enter-sum-input--blue pay__block-enter-sum-input--small-text" value=""  name="fio">
                                </div>
                            </div>
                            <div class="pay__block-enter-sum pay__block-enter-sum--stretch">
                                <h4 class="pay__block-enter-sum-title">
                                    Банк
                                </h4>
                                <div class="pay__block-enter-sum-input-wrapper pay__block-enter-sum-input-wrapper--large">
                                    <select name="bank"  class="pay__block-enter-sum-input pay__block-enter-sum-input--blue pay__block-enter-sum-input--small-text">
                                        <option>Сбербанк</option>
                                        <option>Альфабанк</option>
                                        <option>Т-Банк</option>
                                        <option>ВТБ</option>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class="pay__block-actions" style="margin-top: 40px">
                            <div class="pay__block-actions-text">
                                <p style="color: yellow">
                                    Внимание! Проверьте правильность введенных данных.<br>
                                    После подтверждения, заявку невозможно будет отменить.
                                </p>
                            </div>
                            <div class="pay__block-actions-links">
                                <button type="sumbit" class="pay__block-actions-link pay__block-actions-link--filled">
                                    Отправить
                                </button>
                                <a href="javascript:void(0)" class="pay__block-actions-link reload cancel">
                                    Отменить
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pay__tab js-tabs-item">
                    <form class="pay__block transfer_form" method="POST">
                        <h3 class="pay__block-heading">
                            Создание заявки на отправку
                        </h3>
                        <div class="pay__block-enter-sum">
                            <h4 class="pay__block-enter-sum-title">
                                Введите сумму в рублях
                            </h4>
                            <div class="pay__block-enter-sum-input-wrapper">
                                <input type="tel" class="pay__block-enter-sum-input js-numeric-input-decimals" name="sum_rub" value="0" required>
                            </div>
                        </div>
                        <div class="pay__block-enter-sum pay__block-enter-sum--stretch">
                            <h4 class="pay__block-enter-sum-title">
                                Укажите имя пользователя (или почту), которому хотите отправить:
                            </h4>
                            <div class="pay__block-enter-sum-input-wrapper pay__block-enter-sum-input-wrapper--large">
                                <input type="text" class="pay__block-enter-sum-input pay__block-enter-sum-input--blue pay__block-enter-sum-input--small-text" placeholder="myBestFriend" required="required" name="to">
                            </div>
                        </div>

                        <div class="pay__block-actions">
                            <div class="pay__block-actions-text">
                                <p  style="color: yellow">
                                    Внимание! Проверьте правильность введенных данных.<br>
                                    После подтверждения, заявку невозможно будет отменить.
                                </p>
                            </div>
                            <div class="pay__block-actions-links">
                                <button type="sumbit" class="pay__block-actions-link pay__block-actions-link--filled">
                                    Отправить
                                </button>
                                <a href="javascript:void(0)" class="pay__block-actions-link reload cancel">
                                    Отменить
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="pay__history js-tabs">
            <div class="pay__history-nav">
                <a href="#" class="pay__history-nav-btn js-tabs-btn active">
                    Статистика
                </a>
                <a href="#" class="pay__history-nav-btn js-tabs-btn">
                    Заявки
                </a>
                <a href="#" class="pay__history-nav-btn js-tabs-btn">
                    История баланса
                </a>
                <a href="#" class="pay__history-nav-btn js-tabs-btn">
                    Холд
                </a>
            </div>
            <div class="pay__history-tabs">
                <div class="pay__history-tab js-tabs-item ">
                    <div class="my_stata">
                        <div class="my_stata_item">
                            <p><?php echo number_format(\common\models\Reports::find()->where(['to'=>$user->id])->andWhere(['type'=>'add'])->sum('sum_rub'),0,'',' ')?> ₽</p>
                            <span>всего внесено</span>
                        </div>
                        <div class="my_stata_item">
                            <p><?php echo number_format(\common\models\Reports::find()->where(['to'=>$user->id])->andWhere(['type'=>'bonus'])->sum('sum_rub'),0,'',' ')?> ₽</p>
                            <span>всего заработано</span>
                        </div>
                        <div class="my_stata_item">
                            <p><?php echo number_format(\common\models\Reports::find()->where(['to'=>$user->id])->andWhere(['type'=>'moneyrequest'])->sum('sum_rub'),0,'',' ')?> ₽</p>
                            <span>всего выплачено</span>
                        </div>
                    </div>

                </div>
                <div class="pay__history-tab js-tabs-item pay__history-balance">
                    <ul class="pay__history-orders-list">
                        <?php
                        $btcrates=\common\models\Request::find()->where(['user_id'=>$user->id])
                            ->orderBy(['date'=>SORT_DESC])
                            ->all();
                        if($btcrates)
                        {
                            foreach ($btcrates as $btcrate)
                            {
                                ?>
                                <li class="pay__history-orders-list-item show_info" data-id="<?php echo $btcrate->id?>">
                                    <div class="pay__history-orders-card">
                                        <div class="pay__history-orders-card-text">
                                            Заявка #<?php echo $btcrate->id ?><br>

                                            <?php
                                            if($btcrate->type=='add')
                                            {
                                                echo'Пополнение(₽) '.$btcrate->sum_rub.' ₽';
                                            }
                                            elseif($btcrate->type=='transfer')
                                            {
                                                echo'Перевод '.$btcrate->sum_rub.' ₽';
                                            }
                                            elseif($btcrate->type=='add_usdt')
                                            {
                                                echo'Пополнение(USDT) '.$btcrate->sum_rub.' ₽';
                                            }
                                            elseif($btcrate->type=='moneyrequest')
                                            {
                                                echo'Вывод '.$btcrate->sum_rub.' ₽';
                                            }
                                            ?>

                                        </div>
                                        <div class="pay__history-orders-card-time">
                                            <?php echo date('d.m.Y',strtotime($btcrate->date)) ?><br>
                                            <?php echo date('H:i',strtotime($btcrate->date)) ?>
                                        </div>
                                        <div class="pay__history-orders-card-status">
                                            <?php
                                            if($btcrate->status=='new')
                                            {
                                                echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33">
                                                        <path fill="#00a5e2" d="M16.5 33A16.5 16.5 0 1 1 33 16.5 16.52 16.52 0 0 1 16.5 33Zm0-30A13.5 13.5 0 1 0 30 16.5 13.52 13.52 0 0 0 16.5 3Z" />
                                                        <path fill="#00a5e2" d="m22.53 19.03-8.34-.07-.06-10.63 3-.02.04 7.67 5.38.05-.02 3z" />
                                                    </svg>';
                                            }
                                            elseif($btcrate->status=='done'||$btcrate->status=='success')
                                            {
                                                echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33">
                                                        <path fill="#3de512" d="M16.5 33A16.5 16.5 0 1 1 33 16.5 16.52 16.52 0 0 1 16.5 33Zm0-30A13.5 13.5 0 1 0 30 16.5 13.52 13.52 0 0 0 16.5 3Z" />
                                                        <path fill="#3de512" d="m15.84 22.51-5.86-5.87 2.12-2.12 3.74 3.75 6.74-6.75 2.12 2.12-8.86 8.87z" />
                                                    </svg>';
                                            }
                                            elseif($btcrate->status=='error'||$btcrate->status=='failed')
                                            {
                                                echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33">
                                                        <circle cx="16.5" cy="16.5" r="15" style="fill:none;stroke:#d44c53;stroke-width:3px" />
                                                        <path d="m22.37 19.5-3-3 3-3L20 11.09l-3 3-3-3-2.4 2.39 3 3-3 3 2.36 2.36 3-3 3 3Z" style="fill:#d44c53;fill-rule:evenodd" />
                                                    </svg>';
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>


                    </ul>
                </div>
                <div class="pay__history-tab js-tabs-item ">
                    <div class="pay__history-balance-wrapper">


                        <div class="pay__history-balance">
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        Никнейм
                                    </th>
<!--                                    <th>-->
<!--                                        Уровень-->
<!--                                    </th>-->
                                    <th>
                                        Сумма в руб
                                    </th>
                                    <th>
                                        Дата и время
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $reports=\common\models\Reports::find()->where(['to'=>$user->id,'hold'=>0])->orWhere(['from'=>$user->id,'type'=>'transfer_send'])->orderBy(['date'=>SORT_DESC])->all();
                                if($reports)
                                {
                                    foreach ($reports as $report)
                                    {
                                        ?>
                                        <tr class="<?php if($report->type=='moneyrequest')echo'failure';elseif ($report->type=='add')echo 'success'?>">
                                            <td>
                                                <?php
                                                if($report->type=='moneyrequest')
                                                    echo'Вывод средств';
                                                elseif ($report->type=='add')
                                                    echo 'Зачисление средств';
                                                elseif ($report->type=='buy')
                                                    echo 'Покупка';
                                                else
                                                {
                                                    $u=\common\models\User::findOne($report->from);
                                                    if($u)
                                                        echo $u->nick;
                                                }
                                                    ?>

                                            </td>
<!--                                            <td>--><?php //if($report->line>0)echo $report->line;?><!--</td>-->
                                            <td>
                                                <?php echo $report->sum_rub?>
                                            </td>
                                            <td>
                                                <?php echo date('d.m.Y H:i',strtotime($report->date));?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pay__history-tab js-tabs-item">
                    <div class="hold">
                        <div class="hold_select">
                            <p>1 раунд</p>
                            <div class="hold_select_body">
                                <ul>
                                    <li>1 раунд</li>
                                    <li>2 раунд</li>
                                    <li>3 раунд</li>
                                    <li>4 раунд</li>
                                    <li>5 раунд</li>
                                    <li>6 раунд</li>
                                    <li>7 раунд</li>
                                    <li>8 раунд</li>
                                    <li>9 раунд</li>
                                    <li>10 раунд</li>
                                    <li>11 раунд</li>
                                    <li>12 раунд</li>
                                    <li>13 раунд</li>
                                    <li>14 раунд</li>
                                    <li>15 раунд</li>
                                </ul>
                            </div>
                        </div>
                        <div class="hold_body">
                            <?php
                            for($i=1;$i<=15;$i++)
                            {
                                ?>
                                <div class="hold_body_item <?php if($i==1)echo 'active'?>">
                                    <table class="hold_table">
                                        <thead>
                                        <tr>
                                            <th>Уровень</th>
                                            <th>Сумма в холде</th>
                                            <th>Условия получения средств</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,1) ?> ₽</p>
                                            </td>
                                            <td>1 лично привлечённый в раунд участник,
                                                либо закрытие всех позиций в 2-м уровне личной структуры
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,2) ?> ₽</p>
                                            </td>
                                            <td>2 лично привлечённых в раунд участников,
                                                либо закрытие всех позиций в 3-м уровне личной структуры
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,3) ?> ₽</p>
                                            </td>
                                            <td>3 лично привлечённый в раунд участник,
                                                либо закрытие всех позиций в 4-м уровне личной структуры
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,4) ?> ₽</p>
                                            </td>
                                            <td>6 лично привлечённых в раунд участников
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,5) ?> ₽</p>
                                            </td>
                                            <td>24 лично привлечённых в раунд участников
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <p class="sum hold"><?php echo $user->getHold($i,6) ?> ₽</p>
                                            </td>
                                            <td>72 лично привлечённых в раунд участников
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
