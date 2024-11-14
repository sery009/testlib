<!--<img src="/lc/img/finana_logo.png" alt="">-->
<h6>Запрос успешно принят</h6>
<p>Сделайте перевод суммы на указанную карту</p>
<?php
if(!$model->card)
{
    ?>
    <h2 style="text-align: center;margin: 30px 0 10px">Ошибка</h2>
    <p><?php
        $res=$model->result;
        $dec_res=json_decode($model->result,true);
        //var_dump($dec_res);
        echo $dec_res['errors']["error_message"]['description'];
        ?></p>
    <?php
}
else{
?>
    <div class="transfer_info success">
        <p style="color: yellow">Внимание! Сумма перевода должна точно соответствовать указаной ниже и быть перечислена одним платежом. В случае отправки другой суммы на указанную карту, ваш перевод не будет принят обменником, а денежные средства будут потеряны. При этом мы не сможем их вам вернуть или зачислить на баланс в системе. Будьте внимательны при совершении перевода!</p>
    </div>
<div class="card_wrap
<?php
if($model->bank=='sberbank')
    echo'sber_card';
elseif($model->bank=='alfa')
    echo'alfa_card';
elseif($model->bank=='tinkoff')
    echo'tinkoff_card';
elseif($model->bank=='vtb')
    echo'vtb_card';
elseif($model->bank=='raiffeisenbank')
    echo'raif_card';
else
    echo'sber_card';
?>
">

    <div class="card">
        <div class="card_header">
            <span></span>
            <img src="/lc/img/visa_logo.png" alt="">
        </div>
        <div class="card_field">
            <div class="card_field_info">
                <span style="color: #fffe9f">Сумма для перевода</span>
                <p style="color: #fffe9f;font-size: 34px"><?php echo $model->sum_with_com?> ₽</p>
            </div>
            <div class="card_field_action">
                <a href="javascript:void(0)" class="copy_btn js-copy-link2" data-copy-text="<?php echo $model->sum_with_com?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.04 23.97">
                        <path fill="#fffe9f" d="M18.22,0H7.66A3.83,3.83,0,0,0,4.05,2.66H6.62a1.54,1.54,0,0,1,1-.4H18.22a1.65,1.65,0,0,1,1.61,1.66V15.18a1.65,1.65,0,0,1-.68,1.34V11.29A3.24,3.24,0,0,0,18.25,9L14.11,4.76a3,3,0,0,0-2.19-.93H3.8A3.87,3.87,0,0,0,0,7.76V20A3.87,3.87,0,0,0,3.8,24H15.35A3.87,3.87,0,0,0,19.15,20V19A3.92,3.92,0,0,0,22,15.18V3.92A3.87,3.87,0,0,0,18.22,0ZM17,20a1.63,1.63,0,0,1-1.6,1.65H3.8A1.63,1.63,0,0,1,2.2,20V7.76A1.64,1.64,0,0,1,3.8,6.1h8.12a.9.9,0,0,1,.45.13c0,.52,0,1.15,0,1.76a2.47,2.47,0,0,0,2.39,2.56h1.85l.1.1a.9.9,0,0,1,.26.64Z" />
                    </svg>
                </a>
            </div>
        </div>
        <p class="commission" style="color: #fffe9f;padding-top: 0">С учетом комиссии 7%</p><br>
        <div class="card_field">
            <div class="card_field_info">
                <span>Номер карты для перевода</span>
                <p><?php echo $model->ccMasking();?></p>
            </div>
            <div class="card_field_action">
                <a href="javascript:void(0)" class="copy_btn js-copy-link2" data-copy-text="<?php echo $model->ccMasking();?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.04 23.97">
                        <path d="M18.22,0H7.66A3.83,3.83,0,0,0,4.05,2.66H6.62a1.54,1.54,0,0,1,1-.4H18.22a1.65,1.65,0,0,1,1.61,1.66V15.18a1.65,1.65,0,0,1-.68,1.34V11.29A3.24,3.24,0,0,0,18.25,9L14.11,4.76a3,3,0,0,0-2.19-.93H3.8A3.87,3.87,0,0,0,0,7.76V20A3.87,3.87,0,0,0,3.8,24H15.35A3.87,3.87,0,0,0,19.15,20V19A3.92,3.92,0,0,0,22,15.18V3.92A3.87,3.87,0,0,0,18.22,0ZM17,20a1.63,1.63,0,0,1-1.6,1.65H3.8A1.63,1.63,0,0,1,2.2,20V7.76A1.64,1.64,0,0,1,3.8,6.1h8.12a.9.9,0,0,1,.45.13c0,.52,0,1.15,0,1.76a2.47,2.47,0,0,0,2.39,2.56h1.85l.1.1a.9.9,0,0,1,.26.64Z" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</div>
    <div class="pay__block-timer" style="margin-top: 60px;">
        <div class="pay__block-timer-text">
            Ожидаем Ваш платеж
        </div>
        <div class="pay__block-timer-countdown js-countdown2">
            30:00
        </div>

    </div>

<div class="transfer_info">
    <p>Средства в размере <span><?php echo $model->sum?> ₽</span> будут зачислены на ваш баланс
        после поступления на наш кошелек</p>
</div>
<div class="transfer_action">
    <a href="javascript:void(0)" class="btn v1 active confirm_payment_rub" data-id="<?php echo $model->id?>">Я отправил</a>
    <a href="javascript:void(0)" class="btn v1 cancel2" data-id="<?php echo $model->id?>">Отменить</a>
</div>
<?php }?>