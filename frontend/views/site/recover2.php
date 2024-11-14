<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Установление пароля';
?>

<h1 class="sign-up__heading">
    Установление пароля
</h1>
<div class="cent_content all_height">
    <div class="centered_block">
        <?php $form = ActiveForm::begin(['enableClientScript' => false,'id' => 'login-form','options' => ['class' => 'sign-up__form']]); ?>

        <div class="sign-up__form-fields">
            <div class="sign-up__form-field">
                <div class="sign-up__form-label">
                    Введите Пароль
                </div>
                <input type="password" class="sign-up__form-input" name="password" autofocus="" aria-required="true">

            </div>

        </div>
        <button type="submit" class="sign-up__form-submit">
            Сохранить
        </button>



        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="sign-up__form-link">
        Вход
    </a>
    <a href="<?php echo \yii\helpers\Url::to(['site/registration'])?>" class="sign-up__form-link">
        Регистрация
    </a>
</div>


