<?php

/* @var $this yii\web\View */

$this->title = 'С чего начать';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="page_title">
        <h1 class="study__heading">
            Информация <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M18.272,3.934A14.509,14.509,0,1,0,32.781,18.443,14.509,14.509,0,0,0,18.272,3.934Zm0,26.045A11.536,11.536,0,1,1,29.808,18.443,11.549,11.549,0,0,1,18.272,29.979Zm-4.043-12.19H17.38v7.79h2.973V14.816H14.229v2.973Zm5.886-7.314H17.142v2.854h2.973V10.475Z"/>
            </svg>
        </h1>
    </div>
    <div class="page_box">
        <h4 style="margin-top: 20px">С чего начать</h4>
        <p>Программа состоит из 15 образовательных уровней. Каждому уровню
            соответствует отдельный раунд игровой партнёрской программы.</p>
        <p>Для получения дохода в любом из раундов пользователю необходимо оплатить
            участие в соответствующем ему уровне образовательной программы.</p>
        <h5>Стоимость открытия уровней и количество видеоуроков</h5>
        <div class="round_price_box">
            <?php
            foreach (\common\models\Config::$LEVELS as $level=>$price)
            {
                ?>
                <div class="round_price_item">
                    <div class="round_price_item_num"><?php echo $level?></div>
                    <div class="round_price_item_des">
                        <h6><?php echo number_format($price,0,'',' ')?> ₽</h6>
                        <p><?php echo $cnt=\common\models\Learn::find()->where(['level'=>$level])->count()?> <?php echo \common\models\Config::declension($cnt,['урок','урока','уроков'])?></p>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </div>
    <div class="page_footer">
        <a href="<?php echo yii\helpers\Url::to(['site/index'])?>">На главную</a>
        <a href="<?php echo yii\helpers\Url::to(['learn/index'])?>">В раздел обучения</a>
    </div>
</div>