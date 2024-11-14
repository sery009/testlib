<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтверждение регистрации';
?>
<h1 class="sign-up__heading">
    Ваш аккаунт уже подтвержден
</h1>
<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="sign-up__form-link">
        Вход
    </a>
</div>

