<?php

/* @var $this yii\web\View */

$this->title = 'Обучение';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="study">
        <h1 class="study__heading">
            Обучение <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M18.412,3.372a11,11,0,0,0-1.218.068,10.674,10.674,0,0,0-5.169,19.138,5.491,5.491,0,0,1,2.23,4.378V26.773c0,1.256,1.9,1.812,3.876,1.812,2.168,0,4.439-.667,4.439-1.812v0.184a5.5,5.5,0,0,1,2.236-4.383A10.674,10.674,0,0,0,18.412,3.372Zm4.445,16.605a8.753,8.753,0,0,0-3.352,5.229,7.038,7.038,0,0,1-1.375.131,6.312,6.312,0,0,1-.8-0.048,8.862,8.862,0,0,0-3.359-5.309A7.425,7.425,0,0,1,17.551,6.667a7.85,7.85,0,0,1,.861-0.048A7.424,7.424,0,0,1,22.857,19.977Zm-8.574,8.842v3.142c0,2.3,1.861,3.564,4.157,3.564S22.6,34.262,22.6,31.961V28.819a12.626,12.626,0,0,1-4.146.715A12.815,12.815,0,0,1,14.283,28.819Zm5.883,3.142c0,0.982-1.082,1.128-1.726,1.128s-1.726-.147-1.726-1.128v-0.1a14.481,14.481,0,0,0,3.452,0v0.094ZM4.508,25.209l2.292,2.3,3.4-3.411L7.912,21.8ZM31.967,2.288l-2.292-2.3-3.4,3.41,2.292,2.3ZM10.2,3.4L6.8-.008l-2.292,2.3,3.4,3.41ZM26.272,24.095l3.4,3.411,2.292-2.3-3.4-3.411Z"/>
            </svg>

        </h1>
        <div class="study__heading-text">
            Образовательные уровни
        </div>
        <div class="study__levels">
            <?php
            foreach (\common\models\Config::$LEVELS as $level=>$price)
            {
                $opened=$user->isLevelOpen($level);
                ?>
                <div class="study__levels-accordion  active <?php if($opened)echo'study__levels-accordion--unlocked';?>">
                    <div class="study__levels-accordion-btn js-accordion-btn">
                        <div class="study__levels-accordion-btn-title">
                            Раунд <?php //echo $level?>
                        </div>
                        <?php
                        if(!$opened)
                        {
                            ?>
                            <a href="#open-level_<?php echo $level;?>" class="study__levels-accordion-btn-unlock">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 26" width="19" height="26">
                                    <path d="M17.7,11.16H16.12v-5A6,6,0,0,0,10.4,0H8.6A6,6,0,0,0,2.88,6.13v5H1.3A1.3,1.3,0,0,0,0,12.46v5.67A7.86,7.86,0,0,0,7.86,26h3.28A7.86,7.86,0,0,0,19,18.13V12.46A1.3,1.3,0,0,0,17.7,11.16Zm-11.23-5A2.36,2.36,0,0,1,8.6,3.6h1.8a2.36,2.36,0,0,1,2.13,2.53v5H6.47Zm4.1,13v2.17A.68.68,0,0,1,9.9,22H9.1a.67.67,0,0,1-.67-.67h0V19.17a2.39,2.39,0,1,1,3.21-1.07A2.36,2.36,0,0,1,10.57,19.17Z" />
                                </svg>
                                 <?php echo number_format($price,0,'',' ')?> ₽
                            </a>
                        <?php
                        }
                        ?>
                        <div class="study__levels-accordion-btn-videos-count">
                            <?php echo \common\models\Learn::find()->where(['level'=>$level])->count()?> Видео
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.23 12.74">
                                <polygon points="2.12 12.74 0 10.62 10.62 0 21.23 10.62 19.11 12.74 10.62 4.24 2.12 12.74" />
                            </svg>
                        </div>
                    </div>
                    <?php if($videos=\common\models\Learn::find()->where(['level'=>$level])->all()){?>
                    <div class="study__levels-accordion-content " style="height: auto">
                        <div class="study__levels-accordion-content-inner">
                            <div class="study_slider">
                                <?php
                                $k=0;
                                foreach ($videos as $video)
                                {
                                    $k++;
                                    ?>

                                        <div class="study_slide">
                                            <div class="study_slide_header">
                                                <div class="study_slide_header_title">
                                                    <h6>Урок <?php echo $video->level?>.<?php echo $k?>
                                                    </h6>
                                                    <p><?php echo $video->name;?></p>
                                                </div>
<!--                                                <p class="duration">Длительность </p>-->
                                            </div>
                                            <div class="study_slide_body">
                                                <?php if($opened){
                                                    ?>
                                                    <a class="video_pop" href="#video" data-ifra='<?php echo str_replace('<script src="https://player.vimeo.com/api/player.js"></script>','',$video->video);?>' data-name="<?php echo $video->name?>"><img src="<?php echo $video->image;?>" alt="" class=""></a>
                                                    <?php
                                                    //echo str_replace('<script src="https://player.vimeo.com/api/player.js"></script>','',$video->video);
                                                    ?>

                                                <?php }else{?>
                                                        <div style="position: relative">
                                                            <img src="<?php echo $video->image;?>" alt="" class="" style="opacity: 0.2">
                                                            <a href="#open-level_<?php echo $level;?>" class="study__levels-accordion-btn-unlock"
                                                            style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;display: flex;justify-content: center;align-items: center;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 26" width="19" height="26">
                                                                    <path d="M17.7,11.16H16.12v-5A6,6,0,0,0,10.4,0H8.6A6,6,0,0,0,2.88,6.13v5H1.3A1.3,1.3,0,0,0,0,12.46v5.67A7.86,7.86,0,0,0,7.86,26h3.28A7.86,7.86,0,0,0,19,18.13V12.46A1.3,1.3,0,0,0,17.7,11.16Zm-11.23-5A2.36,2.36,0,0,1,8.6,3.6h1.8a2.36,2.36,0,0,1,2.13,2.53v5H6.47Zm4.1,13v2.17A.68.68,0,0,1,9.9,22H9.1a.67.67,0,0,1-.67-.67h0V19.17a2.39,2.39,0,1,1,3.21-1.07A2.36,2.36,0,0,1,10.57,19.17Z" />
                                                                </svg>
                                                                <?php echo number_format($price,0,'',' ')?> ₽
                                                            </a>
                                                        </div>

                                                <?php }?>
                                            </div>
                                        </div>




                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <?php }?>
                </div>

                <?php
            }
            ?>

        </div>
    </div>

</div>
<?php
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
                    Открыть <?php //echo $level?> Раунд
                    образовательной
                    программы
                </h4>
                <div class="modal__open-level-price">
                    <h5 class="modal__open-level-price-heading">
                        Стоимость уровня:
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
                        Открыть Раунд
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?php echo \yii\helpers\Url::to(['wallet/open_level','id'=>$level])?>" class="modal__open-level-link">
                        Открыть Раунд
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
