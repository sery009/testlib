<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтверждение регистрации';
?>
<h1 class="sign-up__heading">
    Подтверждение регистрации
</h1>
<p>На Ваш Email отправлено письмо для подтверждения регистрации</p>
<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="sign-up__form-link">
        Вход
    </a>
</div>
