<div class="popup_wrapper" id="info_<?php echo $request->id?>">
    <div class="popup_inner">
        <div class="popup add_user_popup">
            <a href="" class="close_popup"></a>
            <div class="popup_body">
                <p style="text-align: center"><?php
                if($request->status=='new')
                {
                    echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33" style="max-width: 50px">
                                                        <path fill="#00a5e2" d="M16.5 33A16.5 16.5 0 1 1 33 16.5 16.52 16.52 0 0 1 16.5 33Zm0-30A13.5 13.5 0 1 0 30 16.5 13.52 13.52 0 0 0 16.5 3Z" />
                                                        <path fill="#00a5e2" d="m22.53 19.03-8.34-.07-.06-10.63 3-.02.04 7.67 5.38.05-.02 3z" />
                                                    </svg>';
                }
                elseif($request->status=='done'||$request->status=='success')
                {
                    echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33" style="max-width: 50px">
                                                        <path fill="#3de512" d="M16.5 33A16.5 16.5 0 1 1 33 16.5 16.52 16.52 0 0 1 16.5 33Zm0-30A13.5 13.5 0 1 0 30 16.5 13.52 13.52 0 0 0 16.5 3Z" />
                                                        <path fill="#3de512" d="m15.84 22.51-5.86-5.87 2.12-2.12 3.74 3.75 6.74-6.75 2.12 2.12-8.86 8.87z" />
                                                    </svg>';
                }
                elseif($request->status=='error'||$request->status=='failed')
                {
                    echo'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33" style="max-width: 50px">
                                                        <circle cx="16.5" cy="16.5" r="15" style="fill:none;stroke:#d44c53;stroke-width:3px" />
                                                        <path d="m22.37 19.5-3-3 3-3L20 11.09l-3 3-3-3-2.4 2.39 3 3-3 3 2.36 2.36 3-3 3 3Z" style="fill:#d44c53;fill-rule:evenodd" />
                                                    </svg>';
                }
                ?></p>
                <h5>Заявка #<?php echo $request->id ?><br>
                    <?php
                    if($request->type=='add')
                    {
                        echo'Пополнение '.$request->sum_rub.' ₽';
                    }
                    elseif($request->type=='transfer')
                    {
                        echo'Перевод '.$request->sum_rub.' ₽';
                    }
                    elseif($request->type=='add_usdt')
                    {
                        echo'Пополнение '.$request->sum_rub.' ₽';
                    }
                    elseif($request->type=='moneyrequest')
                    {
                        echo'Вывод '.$request->sum_rub.' ₽';
                    }
                    ?>
                </h5>
                <?php
                if($request->type=='add')
                {

                    $mr=\common\models\RoubleTransactions::findOne($request->external_id);
                    if($mr)
                    {echo'<br>';
                        echo'<br>';
                        if($request->status=='new'||$request->status=='waiting_payment')
                        {
                            echo'<h1 style="color: #fff">'.$mr->sum_with_com.' ₽<br></h1>';
                            echo'<p>Ожидает перевода на карту</p>';
                            echo'<h5>'.$mr->ccMasking().'<br></h5>';
                        }
                        elseif($request->status=='success')
                        {
                            echo'<h1 style="color: #fff">'.$mr->sum_with_com.' ₽<br></h1>';
                            echo'<p>Поступили на карту</p>';
                            echo'<h5>'.$mr->ccMasking().'<br></h5>';
                        }
                    }
                }
                elseif($request->type=='transfer')
                {
                    $r=\common\models\Reports::find()->where(['type'=>'transfer_get','external_id'=>$request->external_id])->one();
                    $u=\common\models\User::findOne($r->to);
                    if($u)
                    {
                        echo'<p>Пользователю: '.$u->nick.'</p>';
                    }
                }
                elseif($request->type=='add_usdt')
                {
                    $mr=\common\models\BtcRates::findOne($request->external_id);
                    if($mr)
                    {
                        echo'<p>Переведите на кошелек: '.Yii::$app->user->identity->usdtWallet.'<br>
                        Сумму: '.$mr->sum_usd.' USDT</p>';
                    }
                }
                elseif($request->type=='moneyrequest')
                {
                    $mr=\common\models\Moneyrequest::findOne($request->external_id);
                    if($mr)
                    {
                        echo'<p>Кошелек: '.$mr->address.'</p>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>