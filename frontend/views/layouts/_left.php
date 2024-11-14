<?php $user=Yii::$app->user->identity?>
<div class="left">
    <div class="left_top">
        <div class="user_prev">
            <div class="user_pic">
                <a href="javascript:void(0)"><img style="border-radius: 50%" src="<?php echo $user->avatar_src?>" alt=""></a>
            </div>
            <div class="user_prev_text">
                <h6><?php echo $user->nick?></h6>
                <p><a href="<?php echo \yii\helpers\Url::to(['site/logout'])?>">Выход</a></p>
            </div>
        </div>
        <a href="<?php echo \yii\helpers\Url::to(['user/profile'])?>" class="wi set_icon">Настройки профиля</a>
    </div>
    <nav>
        <ul>
            <li class="<?php if(Yii::$app->controller->id=='site')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['site/index2'])?>" class="wi home_icon">Главная</a></li>
            <li class="<?php if(Yii::$app->controller->id=='learn')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['learn/index'])?>" class="wi education_icon">Обучение</a></li>
            <li class="<?php if(Yii::$app->controller->id=='rounds')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['rounds/index'])?>" class="wi rounds_icon">Раунд</a></li>
            <li class="<?php if(Yii::$app->controller->id=='wallet')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['wallet/index'])?>" class="wi wallet_icon">Баланс</a></li>

            <li class="<?php if(Yii::$app->controller->id=='referals')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['referals/index'])?>" class="wi referals_icon">Рефералы</a></li>
            <li class="<?php if(Yii::$app->controller->id=='top')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['top/index'])?>" class="wi top_icon">Топ участников</a></li>
            <li class="<?php if(Yii::$app->controller->id=='')echo'active';?>">
                <a href="javascript:void(0)" class="wi info_icon">Информация</a>
                <ul>

                    <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='index')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/index'])?>">1. О проекте</a></li>
                    <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='what')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/what'])?>">2. Что делать <br>после регистрации</a></li>

                    <!--                    <li class="--><?php //if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='start')echo'active';?><!--"><a href="--><?php //echo \yii\helpers\Url::to(['info/start'])?><!--">С чего начать</a></li>-->
                    <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='earn')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/earn'])?>">3. Как заработать</a></li>
                    <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='work')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/work'])?>">4. Как это работает</a></li>

<!--                    <li class="--><?php //if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='income')echo'active';?><!--"><a href="--><?php //echo \yii\helpers\Url::to(['info/income'])?><!--">Расчет прибыли</a></li>-->
                    <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='faq')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/faq'])?>">5. Частые вопросы</a></li>
                    <?php if($user->has3LinesFull(1)){?>
                        <li class="<?php if(Yii::$app->controller->id=='info'&&Yii::$app->controller->action->id=='mail')echo'active';?>"><a href="<?php echo \yii\helpers\Url::to(['info/faq'])?>">Почта</a></li>
                    <?php }?>
                </ul>
            </li>
<!--            <li><a href="#support" class="wi help_icon">Поддержка</a></li>-->
            <li><a href="https://t.me/LibertyGameSupport" class="wi help_icon">Поддержка</a></li>
            <?php if(Yii::$app->controller->id!='site'){?>
            <li><a href="#social" class="wi help_icon">Социальные сети</a></li>
            <?php }?>
        </ul>
    </nav>
</div>