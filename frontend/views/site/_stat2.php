<div class="rating_block">
    <div class="container">
        <div class="rating">
            <div class="rating_tab">
                <div class="rating_tab_head">
                    <a href="" class="part_icon active">Топ 100 партнеров</a>
                    <a href="" class="ref_icon">Топ  100 реферов</a>
<!--                    <a href="" class="res_icon">Результаты конкурса рефералов</a>-->
                </div>
                <div class="rating_tab_body">
                    <div class="rating_tab_body_item active">
                        <div class="rating_table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Никнейм</th>
                                    <th>Доход партнера</th>
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
                    <div class="rating_tab_body_item">
                        <div class="rating_table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Никнейм</th>
<!--                                    <th>Рефералы</th>-->
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
                                            <td><?php echo $u->nick?></td>
<!--                                            <td>--><?php //echo $u->register_count?><!--</td>-->
                                        </tr>

                                        <?php

                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rating_tab_body_item">
                        <div class="rating_table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Никнейм</th>
<!--                                    <th>Рефералы</th>-->
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
                                            <td><?php echo $u->nick?></td>
<!--                                            <td>--><?php //echo $u->register_count?><!--</td>-->
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
</div>
