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
        <h4 style="margin-top: 20px">Расчет прибыли</h4>
        <table class="profit_table">
            <thead>
            <tr>
                <th>Уровни</th>
                <th>Пассив</th>
                <th>Актив</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>5 400 ₽</td>
                <td>110 700 ₽</td>
            </tr>
            <tr>
                <td>2</td>
                <td>10 800 ₽</td>
                <td>221 400 ₽</td>
            </tr>
            <tr>
                <td>3</td>
                <td>16 200 ₽</td>
                <td>332 100 ₽</td>
            </tr>
            <tr>
                <td>4</td>
                <td>21 600 ₽</td>
                <td>442 800 ₽</td>
            </tr>
            <tr>
                <td>5</td>
                <td>27 000 ₽</td>
                <td>553 500 ₽</td>
            </tr>
            <tr>
                <td>6</td>
                <td>37 800 ₽</td>
                <td>774 900 ₽</td>
            </tr>
            <tr>
                <td>7</td>
                <td>48 600 ₽</td>
                <td>996 300 ₽</td>
            </tr>
            <tr>
                <td>8</td>
                <td>59 400 ₽</td>
                <td>1 217 700 ₽</td>
            </tr>
            <tr>
                <td>9</td>
                <td>70 200 ₽</td>
                <td>1 439 100 ₽</td>
            </tr>
            <tr>
                <td>10</td>
                <td>81 000 ₽</td>
                <td>1 660 500 ₽</td>
            </tr>
            <tr>
                <td>11</td>
                <td>97 200 ₽</td>
                <td>1 992 600 ₽</td>
            </tr>
            <tr>
                <td>12</td>
                <td>113 400 ₽</td>
                <td>2 324 700 ₽</td>
            </tr>
            <tr>
                <td>13</td>
                <td>129 600 ₽</td>
                <td>2 656 800 ₽</td>
            </tr>
            <tr>
                <td>14</td>
                <td>145 800 ₽</td>
                <td>2 988 900 ₽</td>
            </tr>
            <tr>
                <td>15</td>
                <td>162 000 ₽</td>
                <td>3 321 000 ₽</td>
            </tr>

            </tbody>
        </table>
        <div class="profit_box">
            <p>Максимальная общая прибыль участника (пассив)</p>
            <h6>1 026 000 ₽</h6>
        </div>
        <div class="profit_box">
            <p>Максимальная общая прибыль участника (актив)</p>
            <h6>21 033 000 ₽</h6>
        </div>
        <div class="profit_box">
            <p>Бонус первому участнику, заполнившему все позиции до 6-го уровня во всех 15 раундах</p>
            <h6>2 567 000 ₽</h6>
        </div>
    </div>
    <div class="page_footer" style="align-items: center">
        <a href="<?php echo yii\helpers\Url::to(['site/index'])?>">На главную</a>
        <a href="<?php echo yii\helpers\Url::to(['learn/index'])?>">В раздел обучения</a>
    </div>
</div>