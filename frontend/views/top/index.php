<?php

/* @var $this yii\web\View */

$this->title = 'Топ участников';
use yii;
use yii\widgets\ActiveForm;


?>
<div class="main_box">
    <div class="study">

        <h1 class="study__heading">
            Топ участников <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #696969;
                            fill-rule: evenodd;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M18.845,7.833l2.76,5.557,0.693,1.4,1.55,0.224,6.173,0.869-4.472,4.332L24.427,21.3l0.265,1.534,1.076,6.1L20.24,26.046l-1.386-.724-1.386.724-5.508,2.9,1.056-6.117L13.28,21.3l-1.122-1.086L7.677,15.9l6.182-.893,1.55-.224,0.693-1.4,2.739-5.557h0m0.009-2.961a2.932,2.932,0,0,0-2.658,1.642L13.43,12.081l-6.181.892A2.941,2.941,0,0,0,5.606,18l4.473,4.332L9.023,28.448a2.957,2.957,0,0,0,4.3,3.106l5.529-2.888,5.529,2.888a2.957,2.957,0,0,0,4.3-3.106l-1.056-6.117L32.1,18a2.941,2.941,0,0,0-1.643-5.025l-6.181-.892L21.512,6.515a2.932,2.932,0,0,0-2.659-1.642h0Z"/>
            </svg>

        </h1>
        <div class="pay__history js-tabs" style="margin-top: 40px">
            <div class="pay__history-nav">
                <a href="#" class="pay__history-nav-btn js-tabs-btn active">
                    Доход
                </a>
                <a href="#" class="pay__history-nav-btn js-tabs-btn">
                    Реферальная сеть
                </a>
            </div>
            <div class="pay__history-tabs"  style="margin-top: 40px">
                <div class="pay__history-tab js-tabs-item">
                    <div class="pay__history-balance height650">
                        <table>
                            <thead>
                            <tr>
                                <th>Место</th>
                                <th>Никнейм</th>
                                <th>Доход</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $reports=\common\models\Reports::find()->select('sum(sum_rub) as sum_rub,to')->where(['type'=>'bonus','hold'=>0])->groupBy('to')->orderBy(['sum_rub'=>SORT_DESC])->all();
                            if($reports)
                            {
                                $k=0;
                                foreach ($reports as $r)
                                {
                                    $k++;
                                    $u=\common\models\User::findOne($r->to);
                                    ?>
                                    <tr>
                                        <td><?php echo $k?></td>
                                        <td><?php echo $u->nick?></td>
                                        <td><?php echo number_format($r->sum_rub,0,'',' ')?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pay__history-tab js-tabs-item">
                    <div class="pay__history-balance height650">
                        <table>
                            <thead>
                            <tr>
                                <th>Место</th>
                                <th>Никнейм</th>
<!--                                <th>Рефералы</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $users=\common\models\User::find()->where(['status'=>\common\models\User::STATUS_ACTIVE])->andWhere(['>','register_count',0])->orderBy(['register_count'=>SORT_DESC])->limit(100)->all();
                            if($users)
                            {
                                $k=0;
                                foreach ($users as $u)
                                {

                                    $k++;
                                    ?>
                                    <tr>
                                        <td><?php echo $k;?></td>
                                        <td><?php echo $u->nick?></td>
<!--                                        <td>--><?php //echo $u->register_count?><!--</td>-->
                                    </tr>

                                    <?php

                                }
                            }
                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>