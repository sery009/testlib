
<?php $u=\common\models\User::findOne($matrix->user_id);?>
<div class="popup_wrapper" id="user_popup_<?php echo $matrix->id?>">
    <div class="popup_inner">
        <div class="popup user_popup">
            <a href="" class="close_popup"></a>
            <div class="popup_body">
                <div class="user_pic">
                    <a><img src="<?php echo $u->avatar_src;?>" alt=""></a>
                </div>
                <h4><?php echo $u->nick;?></h4>
                <h6>#<?php echo $u->id;?></h6>
                <p><span>Полученный доход:</span><span><?php echo intval(\common\models\Reports::find()->where(['to'=>$u->id,'type'=>'bonus','hold'=>0])->sum('sum_rub'))?> ₽</span></p>
                <p><span>Рефералов:</span><span><?php echo \common\models\User::find()->where(['referal_id'=>$u->id,'status'=>\common\models\User::STATUS_ACTIVE])->count();?></span></p>
                <?php
                $refer=\common\models\User::findOne($u->referal_id);
                if($refer)
                {
                    ?>
                    <div class="referer">
                        <span>Рефер:</span>
                        <p><?php echo $refer->nick;?></p>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

