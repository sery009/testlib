<?php

/* @var $this yii\web\View */

$this->title = 'Раунды';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="rounds">
        <h1 class="study__heading">
            Раунды <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M8,18.991H27.82a2.316,2.316,0,0,0,1.68-3.912L19.632,4.709A2.319,2.319,0,0,0,16.279,4.7L6.328,15.072A2.316,2.316,0,0,0,8,18.991ZM17.95,7.317l8.24,8.659H9.64Zm8.692,14.462H9.147A3.783,3.783,0,0,0,5.363,25.56V29.2A3.783,3.783,0,0,0,9.147,32.98H26.642A3.783,3.783,0,0,0,30.426,29.2V25.56A3.783,3.783,0,0,0,26.642,21.779ZM27.409,29.2a0.768,0.768,0,0,1-.767.766H9.147A0.768,0.768,0,0,1,8.38,29.2V25.56a0.768,0.768,0,0,1,.767-0.767H26.642a0.768,0.768,0,0,1,.767.767V29.2Z"/>
            </svg>

        </h1>
        <div class="study__heading-text">
            Партнерская программа
        </div>
        <ul class="rounds__list">
            <?php
            foreach (\common\models\Config::$LEVELS as $level=>$price)
            {
                $opened=$user->isLevelOpen($level);
                ?>
                <li class="rounds__list-item">
                    <a href="<?php if($opened)echo yii\helpers\Url::to(['rounds/view','id'=>$level]);else echo '#open-level_'.$level;?>" class="rounds__card <?php if($opened)echo 'rounds__card--unlocked'?>">

                        <div class="rounds__card-content">
                            <h3 class="rounds__card-title">
                                Раунд <?php echo $level?>
                            </h3>
                            <div class="rounds__card-price">
                                <div class="rounds__card-icon">
                                    <?php if(!$opened){?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 26" width="19" height="26" class="rounds__card-lock">
                                            <path d="M17.7,11.16H16.12v-5A6,6,0,0,0,10.4,0H8.6A6,6,0,0,0,2.88,6.13v5H1.3A1.3,1.3,0,0,0,0,12.46v5.67A7.86,7.86,0,0,0,7.86,26h3.28A7.86,7.86,0,0,0,19,18.13V12.46A1.3,1.3,0,0,0,17.7,11.16Zm-11.23-5A2.36,2.36,0,0,1,8.6,3.6h1.8a2.36,2.36,0,0,1,2.13,2.53v5H6.47Zm4.1,13v2.17A.68.68,0,0,1,9.9,22H9.1a.67.67,0,0,1-.67-.67h0V19.17a2.39,2.39,0,1,1,3.21-1.07A2.36,2.36,0,0,1,10.57,19.17Z" />
                                        </svg>
                                    <?php }else{?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33" class="rounds__card-ok">
                                            <path d="M16.5,33A16.5,16.5,0,1,1,33,16.5,16.52,16.52,0,0,1,16.5,33Zm0-30A13.5,13.5,0,1,0,30,16.5,13.52,13.52,0,0,0,16.5,3Z" />
                                            <polygon points="15.85 23.5 9.98 17.64 12.11 15.52 15.85 19.26 22.58 12.52 24.7 14.64 15.85 23.5" />
                                        </svg>
                                    <?php }?>
                                </div>
                                <?php echo number_format($price,0,'',' ')?> ₽
                            </div>
                            <p><?php echo \common\models\Matrix::find()->where(['level'=>$level])->count();?></p>
                        </div>
                    </a>
                </li>
            <?php
            }
            ?>

        </ul>
    </div>

</div><?php
foreach (\common\models\Config::$LEVELS as $level=>$price)
{
    ?>
    <div class="modal js-modal" id="open-level_<?php echo $level?>">
        <div class="modal__inner">
            <button class="modal__close js-close-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.78 340.7">
                    <path d="M48,340.7h-.67c-.77-.91-1.48-1.89-2.32-2.73q-21.15-21.2-42.32-42.35c-.83-.83-1.6-1.71-2.71-2.9L122.87,169.86.79,47.78,48.55,0,171.19,122.66,293.47.37Q315.65,22.57,338,45c.85.84,1.82,1.55,2.74,2.32v.66A15.93,15.93,0,0,0,339.52,49Q279.77,108.72,220,168.47c-.6.6-1.12,1.28-1.72,2,.75.79,1.33,1.44,2,2.06q59.5,59.52,119,119c.47.46,1,.85,1.5,1.28v.66a16.27,16.27,0,0,0-1.79,1.37q-22.07,22-44.09,44.08a17.19,17.19,0,0,0-1.36,1.79h-.67c-.35-.42-.66-.87-1-1.25L172.35,220c-.6-.6-1.29-1.12-2-1.72-.79.74-1.44,1.33-2.06,1.95l-119,119C48.83,339.67,48.44,340.21,48,340.7Z" />
                </svg>
            </button>
            <div class="modal__open-level">
                <h4 class="modal__open-level-heading">
                    Открыть <?php echo $level?> раунд
                    образовательной
                    программы
                </h4>
                <div class="modal__open-level-price">
                    <h5 class="modal__open-level-price-heading">
                        Стоимость раунда:
                    </h5>
                    <div class="modal__open-level-price-amount">
                        <?php echo number_format($price,0,'',' ')?> ₽
                    </div>
                </div>
                <?php
                if(strtotime('now')<strtotime(\common\models\Config::$DATES[$level]))
                {
                    ?>
                    <a href="#to_early_<?php echo $level?>" class="modal__open-level-link">
                        Открыть раунд
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?php echo \yii\helpers\Url::to(['wallet/open_level','id'=>$level])?>" class="modal__open-level-link">
                        Открыть раунд
                    </a>
                    <?php
                }
                ?>

                <div class="modal__open-level-balance">
                    На вашем балансе: <?php echo $user->balance?> ₽<br>
                    <a href="<?php echo \yii\helpers\Url::to(['wallet/index'])?>">пополнить баланс</a>
                </div>
            </div>

        </div>
    </div>
    <?php
}
?>