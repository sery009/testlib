<div class="statistic_block">
    <div class="container">
        <div class="statistic">
            <h4>Статистика</h4>
            <div class="statistic_top_box">
                <div class="statistic_top_item">
                    <h6><?php echo number_format(\common\models\User::find()->where(1)->count(),0,'',' ');?></h6>
                    <p>всего участников</p>
                </div>
                <div class="statistic_top_item">
                    <h6><?php echo number_format(-intval(\common\models\Reports::find()->where(['type'=>'buy'])->sum('sum_rub')),0,'',' ');?> ₽</h6>
                    <p>объем продаж курса</p>
                </div>
                <div class="statistic_top_item">
                    <h6><?php echo number_format(intval(\common\models\Reports::find()->where(['type'=>'moneyrequest','status'=>'success'])->sum('sum_rub')),0,'',' ');?> ₽</h6>
                    <p>объем партнерских выплат</p>
                </div>
            </div>
            <div class="statistic_box">
                <div class="statistic_item">
                    <h6 class="wi new_members">Новые участники</h6>
                    <?php
                    $users=\common\models\User::find()->where(['status'=>\common\models\User::STATUS_ACTIVE])->andWhere(['>','id',1])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
                    if($users)
                    {
                        foreach ($users as $u)
                        {
                            ?>
                            <p><span><?php echo $u->nick?></span><?php echo date('d.m.Y H:i',strtotime($u->register_date))?></p>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="statistic_item">
                    <h6 class="wi last_buy">Последние покупки</h6>
                    <?php
                    $reports=\common\models\Reports::find()->where(['type'=>'buy'])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
                    if($reports)
                    {
                        foreach ($reports as $r)
                        {
                            $u=\common\models\User::findOne($r->from);
                            ?>
                            <p><span><?php echo $u->nick?></span><?php echo number_format(-intval($r->sum_rub),0,'',' ')?> ₽</p>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="statistic_item">
                    <h6 class="wi last_pay">Последние выплаты</h6>
                    <?php
                    $reports=\common\models\Reports::find()->where(['type'=>'moneyrequest','status'=>'success'])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
                    if($reports)
                    {
                        foreach ($reports as $r)
                        {
                            $u=\common\models\User::findOne($r->from);
                            ?>
                            <p><span><?php echo $u->nick?></span><?php echo number_format(intval($r->sum_rub),0,'',' ')?> ₽</p>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>