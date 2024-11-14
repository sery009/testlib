<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<h1 class="sign-up__heading">
    Вход
</h1>
<?php $form = ActiveForm::begin(['enableClientScript' => false,'id' => 'login-form','options' => ['class' => 'sign-up__form']]); ?>

    <div class="sign-up__form-fields">
        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Введите Email
            </div>
            <?= $form->field($model, 'email',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>
        </div>

        <div class="sign-up__form-field">
            <div class="sign-up__form-label">
                Введите пароль
            </div>
            <?= $form->field($model, 'password',['template' => '{input}{error}'])->passwordInput(['autofocus' => false,'class'=>'sign-up__form-input sign-up__form-input--password'])->label(false)?>
        </div>
        <div id="captcha"></div>
        <br>
    </div>
    <button type="submit" class="sign-up__form-submit">
        Войти
    </button>

<?php ActiveForm::end(); ?>
<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/recover'])?>" class="sign-up__form-link">
        Забыли пароль?
    </a>
    <a href="<?php echo \yii\helpers\Url::to(['site/registration'])?>" class="sign-up__form-link">
        Регистрация
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