<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>
<h1 class="sign-up__heading">
    Регистрация
</h1>
<?php
$referal=\common\models\User::findOne($model->referal_id);
if($referal)
    echo '<p style="color: #3afe09;font-size: 18px;margin-top: 10px;">Ваш рефер: <b>'.$referal->nick.'</b></p>';
?>
<?php $form = ActiveForm::begin(['enableClientScript' => false,'id' => 'login-form','options' => ['class' => 'sign-up__form']]); ?>
    <div class="sign-up__form-fields">
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Введите Email*
            </div>
            <?= $form->field($model, 'email',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>
        </div>
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Придумайте имя пользователя*
            </div>
            <?= $form->field($model, 'nick',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>
        </div>
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Введите ваш Telegram<br>
                (можно изменить позже в настройках)
            </div>
            <?= $form->field($model, 'telegram',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>

        </div>
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Введите пароль
            </div>
            <?= $form->field($model, 'password',['template' => '{input}{error}'])->passwordInput(['autofocus' => false,'class'=>'sign-up__form-input sign-up__form-input--password'])->label(false)?>
        </div>
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Повторите пароль
            </div>
            <?= $form->field($model, 'password2',['template' => '{input}{error}'])->passwordInput(['autofocus' => false,'class'=>'sign-up__form-input sign-up__form-input--password'])->label(false)?>

        </div>
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">Промокод</div>
            <?= $form->field($model, 'promocode',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>

        </div>
        <div class="sign-up__form-field">
            <input type="checkbox" value="1" required> <span>Принимаю положения и правила <a href="<?php echo \yii\helpers\Url::to(['site/rules'])?>" style="text-decoration: underline" target="_blank">Пользовательского соглашения</a> и <a href="<?php echo \yii\helpers\Url::to(['site/privacy'])?>" style="text-decoration: underline" target="_blank">Политики обработки данных</a></span>
        </div>
        <div id="captcha"></div>
        <br>
        <?php //var_dump($form->errorSummary($model));?>
    </div>
    <button type="submit" class="sign-up__form-submit">
        Зарегистрироваться
    </button>

<?php ActiveForm::end(); ?>
<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/recover'])?>" class="sign-up__form-link">
        Забыли пароль?
    </a>
    <a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="sign-up__form-link">
        Вход
    </a>
</div>




<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>

    var onloadCallback = function() {
        grecaptcha.render( "captcha", {
            "sitekey" : "6LcxPrwbAAAAAODXQ9ElxxHuAvTe27FNkPBVROyv", //Replace this
            "callback" : function(response) {
                document.getElementById("submit").removeAttribute("disabled");
            },
            "expired-callback" : function(response) {
                document.getElementById("submit").setAttribute("disabled", "disabled");
            },

        });
    }
</script>