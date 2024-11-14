<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
?>
<h1 class="sign-up__heading">
    Восстановление пароля
</h1>
<?php $form = ActiveForm::begin(['enableClientScript' => false,'id' => 'login-form','options' => ['class' => 'sign-up__form']]); ?>

<div class="sign-up__form-fields">
    <div class="sign-up__form-field">
        <div class="sign-up__form-label">
            Введите Email
        </div>
        <?= $form->field($model, 'email',['template' => '{input}{error}'])->textInput(['autofocus' => false,'class'=>'sign-up__form-input'])->label(false)?>
    </div>

</div>
<button type="submit" class="sign-up__form-submit">
    Восстановить
</button>

<?php ActiveForm::end(); ?>
<div class="sign-up__form-links">
    <a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="sign-up__form-link">
        Вход
    </a>
    <a href="<?php echo \yii\helpers\Url::to(['site/registration'])?>" class="sign-up__form-link">
        Регистрация
    </a>
</div>

