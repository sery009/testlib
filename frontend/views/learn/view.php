<?php

/* @var $this yii\web\View */

$this->title = 'Обучение';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="study">
        <h1 class="study__heading">
            <?php echo $model->name?>
        </h1>
        <br>
        <?php echo $model->video?>
    </div>

</div>