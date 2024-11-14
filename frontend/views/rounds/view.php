<?php

/* @var $this yii\web\View */

$this->title = 'Раунд '.$round->level;
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
<!--    <div class="main_header">-->
<!--        <a href="--><?php //echo yii\helpers\Url::to(['rounds/index'])?><!--" class="back_link">Выбор раунда</a>-->
<!--    </div>-->

    <div class="round_box">
        <div class="round_info">
            <h4>Раунд <?php //echo $round->level?></h4>
            <p>Всего участников:<span><?php echo $round->getTotal();?></span></p>
            <p>Мои рефералы:<span><?php echo $round->getMyReferals();?></span></p>
            <p>Полученный доход:<span><?php echo $round->getDohod();?> ₽</span></p>
            <p>Сумма в холде:<span><?php echo $round->getHold();?> ₽</span></p>
        </div>
        <div class="round_graphic">
            <div id="chart"></div>
        </div>
    </div>


    <?php if(\common\models\Matrix::find()->where(['user_id'=>$user->id,'level'=>$level])->count()){?>
        <div class="toggle_wrap">
            <a href="" class="toggle active">Матрица раунда</a>
            <a href="" class="toggle">Моя структура</a>
        </div>
    <div class="game_box_list">
        <div class="game_box without_status active"  data-show="1">
            <div class="game_search_box">
                <p>Поиск позиции<br>
                    или пользователя</p>
                <form action="" method="get">
                    <input type="hidden" name="id" value="<?php echo $level?>">
                    <input name="user_id" type="text" placeholder="#126388">
                    <button class="btn_search"></button>
                </form>
<!---->
<!--                <a href="javascript:void(0)" class="btn_img user_icon"></a>-->
<!--                <a href="#subscr" class="btn_img structure_icon"></a>-->
            </div>

            <?php
            if(isset($_GET['user_id'])&&$_GET['user_id'])
            {
                $uu=\common\models\User::find()->where(['id'=>$_GET['user_id']])->orWhere(['like','nick',$_GET['user_id']])->one();
                if($uu)
                    $first=\common\models\Matrix::find()->where(['user_id'=>$uu->id,'level'=>$level])->one();
            }
            else
                $first=\common\models\Matrix::find()->where(['line'=>0,'level'=>$level])->one();
            ?>
            <?php if($first){?>
            <div class="game_line active">
                <div class="game_line_num"></div>
                <div class="game_line_count"></div>
                <div class="game_line_list">
                    <div class="game_line_item game_line_item_show about active" data-id="<?php echo $first->id?>" data-line="<?php echo 0?>" data-first="<?php echo $first->id?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="86" viewBox="0 0 80 86">
                            <path class="cls-1" d="M0.482,29.764a182.675,182.675,0,0,0,0,25.792c0.606,7.1,3.345,10.478,8.463,14.754,5.673,4.74,15.234,9.96,22.193,12.9,6.2,2.616,11.281,2.44,16.926,0,6.417-2.773,15.977-7.829,22.193-12.9,5.161-4.208,7.829-8.643,8.463-14.754a161.042,161.042,0,0,0,0-25.792c-0.743-7.312-3.01-10.623-8.463-14.754a126.025,126.025,0,0,0-22.193-12.9,19.735,19.735,0,0,0-16.926,0A144.7,144.7,0,0,0,8.946,15.01C3.318,19.236,1.092,23.05.482,29.764Z"/>
                            <path class="cls-2" d="M2.542,30.443a173.066,173.066,0,0,0,0,24.436C3.116,61.6,5.712,64.8,10.56,68.856c5.375,4.491,14.432,9.436,21.025,12.218a18.784,18.784,0,0,0,16.036,0c6.079-2.627,15.137-7.418,21.025-12.218,4.89-3.987,7.417-8.188,8.018-13.978a152.552,152.552,0,0,0,0-24.436c-0.7-6.927-2.851-10.064-8.018-13.978A119.4,119.4,0,0,0,47.621,4.246a18.7,18.7,0,0,0-16.036,0A137.083,137.083,0,0,0,10.56,16.464C5.229,20.468,3.12,24.081,2.542,30.443Z"/>
                            <path class="cls-3" d="M59.17,49.594c-2.727-3.6-6.88-6.4-11.037-4.152a14.457,14.457,0,0,1-8.254,1.7,14.458,14.458,0,0,1-8.254-1.7c-4.157-2.247-8.31.548-11.037,4.152-1.189,1.571-1.286,2.62-.556,4.744,2.142,6.235,3.232,8.412,6.323,10.6a21.892,21.892,0,0,0,13.524,4.277A21.891,21.891,0,0,0,53.4,64.938c3.091-2.187,4.182-4.365,6.323-10.6C60.456,52.215,60.359,51.165,59.17,49.594ZM46.191,18.466a12.541,12.541,0,0,0-6.717-1.838A12.8,12.8,0,0,0,32.6,18.466c-2.145,1.72-4.174,4.206-4.025,7.386a46.372,46.372,0,0,0,.9,7.456,10.686,10.686,0,0,0,3.542,6.465c2.605,2.545,3.9,3.435,6.377,3.435s3.781-.89,6.386-3.435a10.686,10.686,0,0,0,3.542-6.465,46.418,46.418,0,0,0,.9-7.456C50.365,22.672,48.336,20.187,46.191,18.466Z"/>
                        </svg>
                        <p class="num"></p>
                    </div>
                </div>
            </div>
            <?php echo $this->render('_view',['user'=>$user,'first'=>$first,'current'=>$first,'line'=>1,'not_show'=>1]);?>
            <?php }else{echo'<h1>Пользователь не найден</h1>';}?>





        </div>
        <?php
        $first=\common\models\Matrix::find()->where(['user_id'=>$user->id,'level'=>$level])->one();
        if($first)
        {
        ?>
        <div class="game_box " >
            <div class="game_search_box">
                <p>Поиск позиции<br>
                    или пользователя</p>
                <form action="">
                    <input type="hidden" name="id" value="<?php echo $level?>">
                    <input name="user_id" type="text" placeholder="#126388">
                    <button class="btn_search"></button>
                </form>
<!---->
<!--                <a href="javascript:void(0)" class="btn_img user_icon"></a>-->
<!--                <a href="#subscr" class="btn_img structure_icon"></a>-->
            </div>
            <?php
            $first=\common\models\Matrix::find()->where(['user_id'=>$user->id,'level'=>$level])->one();
            ?>
            <div class="game_line active">
                <div class="game_line_num"></div>
                <div class="game_line_count"></div>
                <div class="game_line_list">
                    <div class="game_line_item game_line_item_show about active" data-id="<?php echo $first->id?>" data-line="<?php echo 0?>" data-first="<?php echo $first->id?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="86" viewBox="0 0 80 86">
                            <path class="cls-1" d="M0.482,29.764a182.675,182.675,0,0,0,0,25.792c0.606,7.1,3.345,10.478,8.463,14.754,5.673,4.74,15.234,9.96,22.193,12.9,6.2,2.616,11.281,2.44,16.926,0,6.417-2.773,15.977-7.829,22.193-12.9,5.161-4.208,7.829-8.643,8.463-14.754a161.042,161.042,0,0,0,0-25.792c-0.743-7.312-3.01-10.623-8.463-14.754a126.025,126.025,0,0,0-22.193-12.9,19.735,19.735,0,0,0-16.926,0A144.7,144.7,0,0,0,8.946,15.01C3.318,19.236,1.092,23.05.482,29.764Z"/>
                            <path class="cls-2" d="M2.542,30.443a173.066,173.066,0,0,0,0,24.436C3.116,61.6,5.712,64.8,10.56,68.856c5.375,4.491,14.432,9.436,21.025,12.218a18.784,18.784,0,0,0,16.036,0c6.079-2.627,15.137-7.418,21.025-12.218,4.89-3.987,7.417-8.188,8.018-13.978a152.552,152.552,0,0,0,0-24.436c-0.7-6.927-2.851-10.064-8.018-13.978A119.4,119.4,0,0,0,47.621,4.246a18.7,18.7,0,0,0-16.036,0A137.083,137.083,0,0,0,10.56,16.464C5.229,20.468,3.12,24.081,2.542,30.443Z"/>
                            <path class="cls-3" d="M59.17,49.594c-2.727-3.6-6.88-6.4-11.037-4.152a14.457,14.457,0,0,1-8.254,1.7,14.458,14.458,0,0,1-8.254-1.7c-4.157-2.247-8.31.548-11.037,4.152-1.189,1.571-1.286,2.62-.556,4.744,2.142,6.235,3.232,8.412,6.323,10.6a21.892,21.892,0,0,0,13.524,4.277A21.891,21.891,0,0,0,53.4,64.938c3.091-2.187,4.182-4.365,6.323-10.6C60.456,52.215,60.359,51.165,59.17,49.594ZM46.191,18.466a12.541,12.541,0,0,0-6.717-1.838A12.8,12.8,0,0,0,32.6,18.466c-2.145,1.72-4.174,4.206-4.025,7.386a46.372,46.372,0,0,0,.9,7.456,10.686,10.686,0,0,0,3.542,6.465c2.605,2.545,3.9,3.435,6.377,3.435s3.781-.89,6.386-3.435a10.686,10.686,0,0,0,3.542-6.465,46.418,46.418,0,0,0,.9-7.456C50.365,22.672,48.336,20.187,46.191,18.466Z"/>
                        </svg>
                        <p class="num"></p>
                    </div>
                </div>
            </div>
            <?php echo $this->render('_view',['user'=>$user,'first'=>$first,'current'=>$first,'line'=>1]);?>
        </div>
        <?php }?>
    </div>
    <?php }else{?>
        <h4 class="modal__open-level-heading">
            Открыть раунд
            образовательной
            программы
        </h4>
        <div class="modal__open-level-price">
            <h5 class="modal__open-level-price-heading">
                Стоимость раунда:
            </h5>
            <div class="modal__open-level-price-amount">
                <?php echo number_format(\common\models\Config::$LEVELS['price'],0,'',' ')?> ₽
            </div>
        </div>
        <div style="text-align: center">
            <a href="<?php echo \yii\helpers\Url::to(['wallet/open_level','id'=>1])?>" class="modal__open-level-link">
                Открыть раунд
            </a>
        </div>
        <div class="modal__open-level-balance">
            На вашем балансе: <?php echo $user->balance?> ₽<br>
            <a href="<?php echo \yii\helpers\Url::to(['wallet/index'])?>">пополнить баланс</a>
        </div>
    <?php }?>
</div>
<?php
$dates=[];
$users=[];
$res=\common\models\Matrix::find()->select('count(*) as user_id,date')->where(['level'=>$level])->groupBy('date(date)')->all();
if($res)
{
    $cnt=0;
    foreach ($res as $r)
    {
        $cnt+=$r->user_id;
        $dates[]=date('Y-m-d',strtotime($r->date));
        $users[]=$cnt;
    }
}

?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            name: "Users",
            data: [0,<?php echo implode(',',$users)?>]
        }],
        chart: {
            toolbar: {
                show: false,
            },
            type: 'area',
            height: 180,
            zoom: {
                enabled: false,
                autoScaleYaxis: false,
            },
            fontFamily: '"Montserrat", Arial, sans-serif'
        },
        subtitle: {
            text: 'Количество участников',
            align: 'right',
        },
        colors: ['#38f50a'],
        grid: {
            show: false,
            borderColor: '#A66BFF',
            position: 'front',
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 0,
        },

        labels:  ["2024-10-20",<?php
            if($dates)
            {
                foreach ($dates as $d)
                    echo'"'.$d.'",';
            }
            ?>],
        xaxis: {
            type: 'datetime',
            labels: {
                style: {
                    colors: '#8d8d8d',
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#8d8d8d',
                },
            },
        },
        legend: {
            horizontalAlign: 'left'
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>