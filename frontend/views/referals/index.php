<?php

/* @var $this yii\web\View */

$this->title = 'Рефералы';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="study">
        <h1 class="study__heading">
            Рефералы <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M28.221,19.817a6.671,6.671,0,0,0-2.555.506l-2.829-4.861a6.544,6.544,0,0,0,2.182-4.873,6.646,6.646,0,0,0-13.291,0,6.543,6.543,0,0,0,1.97,4.682l-2.885,4.956a6.58,6.58,0,1,0,4.358,6.182,6.541,6.541,0,0,0-1.915-4.626l2.9-4.985a6.644,6.644,0,0,0,4.162.094L23.293,22a6.531,6.531,0,0,0-1.717,4.411A6.646,6.646,0,1,0,28.221,19.817ZM8.525,30.124a3.715,3.715,0,1,1,3.746-3.715A3.731,3.731,0,0,1,8.525,30.124Zm6.1-19.535A3.746,3.746,0,1,1,18.373,14.3,3.73,3.73,0,0,1,14.628,10.589ZM28.221,30.124a3.715,3.715,0,1,1,3.746-3.715A3.731,3.731,0,0,1,28.221,30.124Z"/>
            </svg>
        </h1>
        <br>
        <div class="study__heading-text">
            Мои промокоды
        </div>
        <br>
        <a href="#buy_promo" class="pay__history-nav-btn active">
            Купить промокод
        </a>
        <br>
        <br>
        <br>
        <div class="study__heading-text">
            Список промокодов
        </div>
        <?php
        $cnt=\common\models\User::find()->where(['referal_id'=>$user->id,'status'=>\common\models\User::STATUS_PROMO])->count();
        if($cnt>0)
        {
            ?>
            <p style="margin-top: 20px;color: var(--gt1)">Всего промокодов: <?php echo $cnt?></p>
            <div class="pay__history-balance height650" style="margin-top: 40px">
                <table>
                    <thead>
                    <tr>
                        <th>Промокод</th>
                        <th>Копировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users=\common\models\User::find()->where(['referal_id'=>$user->id,'status'=>\common\models\User::STATUS_PROMO])->all();
                    if($users)
                    {
                        foreach ($users as $u)
                        {
                            ?>
                            <tr>
                                <td><?php echo $u->promocode?></td>
                                <td><a href="javascript:void(0)" data-copy-text="<?php echo $u->promocode?>" class="pay__history-nav-btn active js-copy-link2">Копировать</a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <?php
        }
        else
            echo'<p style="margin-top: 20px;color: var(--gt1)">Здесь будут отображены промокоды</p>';
        ?>



        <p style="margin-top: 20px;color: var(--gt1)">Ваша реферальная ссылка</p>
        <p style="color: var(--sec);margin-top: 5px;font-weight: bold;display: flex;align-items: center" id="link"><?php echo $user->referal_link?>
            <a
                    style="display: flex;
  align-items: center;
  gap: 10px;
  color: #00a5e2;
  font-size: 12px;
  line-height: 14px;padding-left: 10px"
                    href="javascript:void(0)" class="copy_ref_link" data-copy-text="<?php echo $user->referal_link?>" >
                <svg style="width: 24px;
  height: 24px;
  fill: #00a5e2;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.04 23.97" class="copy_ref_link">
                    <path d="M18.22,0H7.66A3.83,3.83,0,0,0,4.05,2.66H6.62a1.54,1.54,0,0,1,1-.4H18.22a1.65,1.65,0,0,1,1.61,1.66V15.18a1.65,1.65,0,0,1-.68,1.34V11.29A3.24,3.24,0,0,0,18.25,9L14.11,4.76a3,3,0,0,0-2.19-.93H3.8A3.87,3.87,0,0,0,0,7.76V20A3.87,3.87,0,0,0,3.8,24H15.35A3.87,3.87,0,0,0,19.15,20V19A3.92,3.92,0,0,0,22,15.18V3.92A3.87,3.87,0,0,0,18.22,0ZM17,20a1.63,1.63,0,0,1-1.6,1.65H3.8A1.63,1.63,0,0,1,2.2,20V7.76A1.64,1.64,0,0,1,3.8,6.1h8.12a.9.9,0,0,1,.45.13c0,.52,0,1.15,0,1.76a2.47,2.47,0,0,0,2.39,2.56h1.85l.1.1a.9.9,0,0,1,.26.64Z" />
                </svg>
            </a>
        </p>
<?php
$cnt=\common\models\User::find()->where(['referal_id'=>$user->id,'status'=>\common\models\User::STATUS_ACTIVE])->count();
if($cnt>0)
{
    ?>
    <p style="margin-top: 20px;color: var(--gt1)">Всего рефералов: <?php echo $cnt?></p>
    <div class="pay__history-balance height650" style="margin-top: 40px">
        <table>
            <thead>
            <tr>
                <th>Никнейм</th>
                <th>Почта</th>
                <th>Статус</th>
<!--                <th>Телеграм</th>-->
<!--                <th>Уровень</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            $users=\common\models\User::find()->where(['referal_id'=>$user->id,'status'=>\common\models\User::STATUS_ACTIVE])->all();
            if($users)
            {
                foreach ($users as $u)
                {
                    ?>
                    <tr>
                        <td><?php echo $u->nick?></td>
                        <td><?php echo $u->email?></td>
                        <td><?php if(\common\models\Matrix::find()->where(['user_id'=>$u->id])->count()>0)echo 'Активен'?></td>
<!--                        <td>--><?php //echo $u->telegram?><!--</td>-->
<!--                        <td>1</td>-->
                    </tr>
                    <?php
                }
            }
            ?>

            </tbody>
        </table>
    </div>
        <?php
}
else
    echo'<p style="margin-top: 20px;color: var(--gt1)">Здесь будут отображены участники, которые зарегистрировались по вашей реферальной ссылке</p>';
?>

    </div>
</div>