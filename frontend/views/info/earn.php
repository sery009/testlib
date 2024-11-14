<?php

/* @var $this yii\web\View */

$this->title = 'Как заработать';
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

        <h4 style="margin-top: 20px">Как заработать</h4>
        <div style="padding:86.25% 0 0 0;position:relative;margin: 20px 0">
            <iframe src="https://player.vimeo.com/video/1026213711" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
            <img src="https://i.vimeocdn.com/video/1440519900-1ed64e863a5bdccc920bfbc297ba222da8b5d35a2629d42914fd601615a42902-d?mw=1300&mh=731"
                 alt="" class="" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;">
        </div><script src="https://player.vimeo.com/api/player.js"></script>

        <p>Участник получает доход с любых пользователей, занявших позиции в открытых уровнях
            его личной структуры. Если участник не привлек ни одного пользователя, то он
            получит доход со всех позиций заполненных в первых 3-х уровнях его личной структуры,
            при этом доход с позиций каждого уровня будет зачислен ему на баланс только после
            заполнения всех позиций следующего уровня его личной структуры.</p>
        <p>Для мгновенного получения дохода с заполняющихся позиций личной структуры
            вплоть до 6-го уровня участнику необходимо привлекать пользователей по
            своей реферальной ссылке, при этом количество привлечённых участником
            пользователей для каждого раунда учитывается отдельно.</p>
        <h5 class="centh5_mobile">Алгоритм распределения средств</h5>
<!--        <div class="bonuses_list cent_flex">-->
<!--            <div class="bonus_row">-->
<!--                <h6>Уровень структуры</h6>-->
<!--                <p>1</p>-->
<!--                <p>2</p>-->
<!--                <p>3</p>-->
<!--                <p>4</p>-->
<!--                <p>5</p>-->
<!--                <p>6</p>-->
<!--            </div>-->
<!--            <div class="bonus_row">-->
<!--                <h6>Доход участника</h6>-->
<!--                <p>40%</p>-->
<!--                <p>10%</p>-->
<!--                <p>10%</p>-->
<!--                <p>10%</p>-->
<!--                <p>10%</p>-->
<!--                <p>10%</p>-->
<!--            </div>-->
<!--        </div>-->
        <style>
            table{margin-top: 20px}
            table td, table th{padding: 5px 10px;text-align: center}
        </style>
        <table style="width: 100%" border="1" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th colspan="4">Тринар</th>
                <th>1 000 ₽</th>
            </tr>
            <tr>
                <th rowspan="2">Линии структуры</th>
                <th rowspan="2">%</th>
                <th colspan="2">Кол-во человек</th>
                <th rowspan="2">Доход</th>
            </tr>
            <tr>
                <th>В линии</th>
                <th>Расхолд</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1 линия</td>
                <td>40</td>
                <td>3</td>
                <td>1</td>
                <td>1&nbsp;200&nbsp;₽</td>
            </tr>
            <tr>
                <td>2 линия</td>
                <td>10</td>
                <td>9</td>
                <td>2</td>
                <td>900&nbsp;₽</td>
            </tr>
            <tr>
                <td>3 линия</td>
                <td>10</td>
                <td>27</td>
                <td>3</td>
                <td>2&nbsp;700&nbsp;₽</td>
            </tr>
            <tr>
                <td>4 линия</td>
                <td>10</td>
                <td>81</td>
                <td>8</td>
                <td>8&nbsp;100&nbsp;₽</td>
            </tr>
            <tr>
                <td>5 линия</td>
                <td>10</td>
                <td>243</td>
                <td>24</td>
                <td>24&nbsp;300&nbsp;₽</td>
            </tr>
            <tr>
                <td>6 линия</td>
                <td>10</td>
                <td>729</td>
                <td>72</td>
                <td>72&nbsp;900&nbsp;₽</td>
            </tr>
            <tr>
                <td><b>Итого</b></td>
                <td><b>90</b></td>
                <td><b>1092</b></td>
                <td><b>72</b></td>
                <td><b>110&nbsp;100&nbsp;₽</b></td>
            </tr>
            </tbody>
        </table>

    </div>
    <div class="page_footer">
        <a href="<?php echo yii\helpers\Url::to(['site/index'])?>">На главную</a>
        <a href="<?php echo yii\helpers\Url::to(['learn/index'])?>">В раздел обучения</a>
    </div>
</div>
