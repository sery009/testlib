<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Ошибка';
?>
<h1 class="sign-up__heading">
    Ошибка
</h1>
<p><?php var_dump(nl2br(Html::encode($message))); ?></p>
