<?php

/* @var $this yii\web\View */

$this->title = 'Настройки';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="page_title">
        <h4>Настройки</h4>
        <div class="breadcrumbs">
            <a href="javascript:void(0)">ID пользователя: #<?php echo $user->id;?></a>
        </div>
    </div>

    <div class="profile_page">
        <div class="profile_info_item">
            <span>Никнейм:</span>
            <p><?php echo $user->nick;?></p>
        </div>
        <div class="profile_info_item">
            <span>Почта:</span>
            <p><?php echo $user->email;?></p>
        </div>
        <?php
        $referal=\common\models\User::findOne($user->referal_id);
        if($referal)
        {
        ?>
        <div class="profile_info_item">
            <span>Ваш Рефер:</span>
            <p><?php echo $referal->nick;?></p>
        </div>
        <?php }?>

        <div class="profile_settings">
            <div class="profile_field_box">
                <p>Ваш Telegram аккаунт:</p>
                <?php $form = ActiveForm::begin(['enableClientScript' => false,'options' => ['class' => '']]); ?>

                    <?= $form->field($user, 'telegram',['template' => '{input}<div class="entry_data"><button></button></div>{error}','options'=>['class'=>'profile_field']])->textInput(['autofocus' => false,'class'=>'valid','placeholder'=>'Введите telegram аккаунт'])->label(false)?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="profile_field_box">
                <p>Ваш Instagram аккаунт:</p>
                <?php $form = ActiveForm::begin(['enableClientScript' => false,'options' => ['class' => '']]); ?>

                <?= $form->field($user, 'inst',['template' => '{input}<div class="entry_data"><button></button></div>{error}','options'=>['class'=>'profile_field']])->textInput(['autofocus' => false,'class'=>'valid','placeholder'=>'Введите instagram аккаунт'])->label(false)?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="profile_field_box">
                <p>Сменить пароль:</p>
                <?php $form = ActiveForm::begin(['enableClientScript' => false,'options' => ['class' => '']]); ?>
                <?= $form->field($user, 'pass3',['template' => '{input}','options'=>['class'=>'profile_field']])->passwordInput(['autofocus' => false,'class'=>'valid','placeholder'=>'Старый пароль'])->label(false)?>
                <?= $form->field($user, 'pass',['template' => '{input}','options'=>['class'=>'profile_field']])->passwordInput(['autofocus' => false,'class'=>'valid','placeholder'=>'Введите новый пароль'])->label(false)?>
                <?= $form->field($user, 'pass2',['template' => '{input}<div class="entry_data"><button></button></div>','options'=>['class'=>'profile_field']])->passwordInput(['autofocus' => false,'class'=>'valid','placeholder'=>'Повторите новый пароль'])->label(false)?>
                <p style="margin-top: 20px;"><?= $form->errorSummary($user) ?></p>

                <?php ActiveForm::end(); ?>
            </div>
<!--            <div class="profile_field_box">-->
<!--                <p>Восстановить пароль:</p>-->
<!--                <div class="profile_field">-->
<!--                    <input type="text" placeholder="Введите вашу почту">-->
<!--                    <div class="entry_data"></div>-->
<!--                </div>-->
<!--                <span>На вашу почту будет отправлено письмо <br>со ссылкой для смены пароля.</span>-->
<!--            </div>-->
        </div>
    </div>
    <div class="breadcrumbs">
        <a href="<?php echo \yii\helpers\Url::to(['site/privacy'])?>" target="_blank"><img src="/lc/img/ok_icon.png" style="padding-right: 5px">Политика конфиденциальности</a>
    </div>
    <div class="breadcrumbs">
        <a href="<?php echo \yii\helpers\Url::to(['site/rules'])?>" target="_blank"><img src="/lc/img/ok_icon.png" style="padding-right: 5px">Пользовательское соглашение</a>
    </div>
</div>