<?php
namespace frontend\controllers;

use common\models\BtcAddress;
use common\models\CarBrand;
use common\models\CarModel;
use common\models\Config;
use common\models\Invest;
use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Open;
use common\models\Program;
use common\models\RecoverForm;
use common\models\Reports;
use common\models\Request;
use common\models\RoubleTransactions;
use common\models\User;

use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\data\Pagination;
use frontend\models\PasswordResetRequestForm;
use frontend\models\SignupForm;
use yii\web\NotFoundHttpException;
use common\services\auth\SignupService;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['check_cashalot','privacy','rules','index2','check_finana','table','link','check_invest','al','recover2','logout', 'registration','login','recover','success_registration','fail','fail_confirm','success','recover','success_recover2','success_recover'],
                'rules' => [
                    [
                        'actions' => ['check_cashalot','privacy','rules','index2','check_finana','table','link','check_invest','al','recover2','registration','login','recover','success_registration','fail','fail_confirm','recover','success_recover2','success_recover','success'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['check_cashalot','privacy','rules','index2','check_finana','table','link','check_invest','al','recover','recover2','logout','success_registration','fail','fail_confirm','success','check_btc','login','registration','success'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionCheck_cashalot()
    {

        $a=file_get_contents('php://input');
        file_put_contents('cashalot.txt',"\r\n".date('d.m.Y H:i:s',strtotime('now')),FILE_APPEND);
        file_put_contents('cashalot.txt',"\r\n".$a,FILE_APPEND);
        file_put_contents('cashalot.txt',"\r\nGET".json_encode($_GET),FILE_APPEND);
        file_put_contents('cashalot.txt',"\r\nPOST".json_encode($_POST),FILE_APPEND);
        $dec=json_decode($a,true);
        $tr=RoubleTransactions::find()->where(['external_id'=>$dec['uuid']])->andWhere(['<>','status','approved'])->one();
        if($a&&$tr)
        {
            if($dec)
            {
                if($dec['status']=='approved')
                {
                    $sum_rub=$tr->sum;
                    $user=User::findOne($tr->user_id);
                    $user->balance+=$sum_rub;
                    $user->save();

                    $report=new Reports();
                    $report->from=$user->id;
                    $report->to=$user->id;
                    $report->type='add';
                    $report->sum_rub=$sum_rub;
                    $report->date=date('Y-m-d H:i:s');
                    $report->status='new';
                    $report->external_id=$tr->id;
                    $report->save();

                    $req=Request::find()->where(['type'=>'add','external_id'=>$tr->id])->one();
                    if($req)
                    {
                        $req->status='success';
                        $req->save();
                    }

                    $message='Поступление '.$tr->sum_with_com.' руб';
                    $message.="\r\nПользователь ".$user->getConcatened4();
                    file_get_contents('https://api.telegram.org/bot'.Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-1001502172066');
                }
                $tr->status=$dec['status'];
                $tr->save();

            }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo'';
        //echo'{"status": "ok"}';
        exit();
    }

    public function actionTable()
    {
        //$rt=new RoubleTransactions();
        //$rt->saveWebhook();
        echo'<div class="rating_box_body scrollbar-inner">';
        $users=\common\models\User::find()->where(['status'=>\common\models\User::STATUS_ACTIVE])->andWhere(['>','register_count',0])->orderBy(['register_count'=>SORT_DESC])->limit(100)->all();
        if($users)
        {
            $k=0;
            foreach ($users as $u)
            {
                    $k++;
                ?>
                <div class="rating_body_line" data-nick="<?php echo mb_strtolower(trim($u->nick))?>" data-place="<?php echo $k?>" data-cnt="<?php echo $u->register_count?>" data-prize="<?php echo \common\models\Config::places($k);?>">
                    <p><?php echo $k?></p>
                    <p><?php echo $u->nick?></p>
                    <p><?php echo $u->register_count?></p>
                    <p><?php echo \common\models\Config::places($k);?> ₽</p>
                </div>
        <?php
            }
        }
        echo'</div>';
        exit();
    }

    public function actionLink()
    {
        if(($_GET['email'])&&($_GET['nick'])&&($_GET['telegram']))
        {
            $user=User::find()->where(['nick'=>$_GET['nick']])->orWhere(['email'=>$_GET['email']])->one();
            if($user)
            {
                if($_GET['login'])
                {
                    ?>
                    <script>$(".get_link_res").html('<p><?php echo $user->getReferal_link();?><a id="link"  class="copy_btn" href="javascript:void(0)"></a></p><div style="margin-top: 40px;display: block;text-align: center"><div class="ya-share2" data-size="l" data-url="<?php echo $user->getReferal_link()?>" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div></div>')</script>
                    <script src="https://yastatic.net/share2/share.js" async></script>
                    <?php
               }
                else
                    echo '<script>$(".get_link_res").html("<p>Вы уже зарегистрированы в системе</p>")</script>';
            }
            else
            {
                $user = new User();
                $user->generateAuthKey();
                $password='1111';
                $user->setPassword($password);
                $user->email = $_GET['email'];
                $user->name = $_GET['nick'];
                $user->nick = $_GET['nick'];
                $ref=User::find()->where(['nick'=>$_GET['id']])->one();
                if($ref)
                {
                    $user->referal_id = $ref->id;
                }
                else
                    $user->referal_id = 1;

                if($user->referal_id==2)
                    $user->referal_id =1;


                $user->confirm = Yii::$app->security->generateRandomString();
                $user->status = User::STATUS_WAIT;
                $user->phone='';
                $user->phone_r='';
                $user->role='user';
                $user->created_at=time();
                $user->register_date=date('Y-m-d H:i:s');
                $user->save();

                $sent=Config::sendMessage('user-signup-comfirm-html',['user' => $user,'password'=>$password],$user->email,'Подтверждение регистрации');


                echo '<script>$(".get_link_res").html("<p style=\'text-align:center;margin-top:20px\'>Для участия в рейтинге<br> Вам необходимо подтвердить свой Email</p>")</script>';
                $message='Зарегистрирован новый пользователь '.$user->getConcatened3();
                if($ref)
                    $message.="\r\nПригласитель: ".$ref->getConcatened3();
                file_get_contents('https://api.telegram.org/bot'.Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-683895913');


            }
        }
        elseif($_GET['nick'])
        {
            $user=User::find()->where(['nick'=>$_GET['nick']])->one();
            if($user)
            {
                ?>
                <script>$(".get_link_res").html('<p><?php echo $user->getReferal_link();?><a id="link"  class="copy_btn" href="javascript:void(0)"></a></p><div style="margin-top: 40px;display: block;text-align: center"><div class="ya-share2" data-size="l" data-url="<?php echo $user->getReferal_link()?>" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div></div>')</script>
                <script src="https://yastatic.net/share2/share.js" async></script>
            <?php
            }
            else
                echo'<script>$(".get_link_res").html("<p>Пользователь не найден</p>")</script>';
        }
        elseif($_GET['email'])
        {
            $user=User::find()->where(['email'=>$_GET['email']])->one();
            if($user)
            {
                ?>
                <script>$(".get_link_res").html('<p><?php echo $user->getReferal_link();?><a id="link"  class="copy_btn" href="javascript:void(0)"></a></p><div style="margin-top: 40px;display: block;text-align: center"><div class="ya-share2" data-size="l" data-url="<?php echo $user->getReferal_link()?>" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div></div>')</script>
                <script src="https://yastatic.net/share2/share.js" async></script>
            <?php
            }
            else
                echo'<script>$(".get_link_res").html("<p>Пользователь не найден</p>")</script>';
        }
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPrivacy()
    {
        if($_GET['id'])
        {
            setcookie('rpis',$_GET['id'],time()+60*60*24*30,'/');
        }
        $this->layout='land';
        return $this->render('privacy');
    }

    public function actionRules()
    {
        if($_GET['id'])
        {
            setcookie('rpis',$_GET['id'],time()+60*60*24*30,'/');
        }
        $this->layout='land';
        return $this->render('rules');
    }

    public function actionIndex()
    {
        if($_GET['id'])
        {
            setcookie('rpis',$_GET['id'],time()+60*60*24*30,'/');
        }
        $this->layout='land';
        return $this->render('index2');
    }

    public function actionIndex2()
    {
        if($_GET['id'])
        {
            setcookie('rpis',$_GET['id'],time()+60*60*24*30,'/');
        }
        $this->layout='land';
        return $this->render('index2');
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    public function actionLogin()
    {
       // return $this->redirect(['site/index']);
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if (!$_POST["g-recaptcha-response"]) {
                // Если данных нет, то программа останавливается и выводит ошибку
                return $this->redirect('/');
            }
            else { // Иначе создаём запрос для проверки капчи
                // URL куда отправлять запрос для проверки
                $url = "https://www.google.com/recaptcha/api/siteverify";
                // Ключ для сервера
                $key = "6LcxPrwbAAAAAMA4wiNIhMrH5lB22V-fCPSZsoLX";
                // Данные для запроса
                $query = array(
                    "secret" => $key, // Ключ для сервера
                    "response" => $_POST["g-recaptcha-response"], // Данные от капчи
                    "remoteip" => $_SERVER['REMOTE_ADDR'] // Адрес сервера
                );

                // Создаём запрос для отправки
                $ch = curl_init();
                // Настраиваем запрос
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                // отправляет и возвращает данные
                $data = json_decode(curl_exec($ch), $assoc = true);
                // Закрытие соединения
                curl_close($ch);

                // Если нет success то
                if (!$data['success']) {
                    // Останавливает программу и выводит "ВЫ РОБОТ"
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                } else {
                    if($model->login())
                        return $this->redirect(['site/index']);

                }
            }



        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }


        $form = new SignupForm();
        if(isset($_COOKIE['rpis'])&&$_COOKIE['rpis'])
            $form->referal_id=$_COOKIE['rpis'];
        if(isset($_GET['id'])&&$_GET['id'])
            $form->referal_id=$_GET['id'];


        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            if (!$_POST["g-recaptcha-response"]) {
                // Если данных нет, то программа останавливается и выводит ошибку
                return $this->redirect('/');
            }
            else
            { // Иначе создаём запрос для проверки капчи
                // URL куда отправлять запрос для проверки
                $url = "https://www.google.com/recaptcha/api/siteverify";
                // Ключ для сервера
                $key = "6LcxPrwbAAAAAMA4wiNIhMrH5lB22V-fCPSZsoLX";
                // Данные для запроса
                $query = array(
                    "secret" => $key, // Ключ для сервера
                    "response" => $_POST["g-recaptcha-response"], // Данные от капчи
                    "remoteip" => $_SERVER['REMOTE_ADDR'] // Адрес сервера
                );

                // Создаём запрос для отправки
                $ch = curl_init();
                // Настраиваем запрос
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                // отправляет и возвращает данные
                $data = json_decode(curl_exec($ch), $assoc = true);
                // Закрытие соединения
                curl_close($ch);

                // Если нет success то
                if (!$data['success']) {
                    // Останавливает программу и выводит "ВЫ РОБОТ"
                    return $this->render('registration', [
                        'model' => $form,
                    ]);
                } else {

                    $signupService = new SignupService();

                    try {
                        $user = $signupService->signup($form);

                        $signupService->sentEmailConfirm($user,$form->password);
                        return $this->redirect(Url::toRoute(['site/success_registration']));
                    } catch (\RuntimeException $e) {
                        Yii::$app->errorHandler->logException($e);
                        Yii::$app->session->setFlash('error', $e->getMessage());
                    }
                }
            }




        }

        return $this->render('registration', [
            'model' => $form,
        ]);
    }

    public function actionSignupConfirm($token)
    {
        $signupService = new SignupService();

        try {

            $user = User::findOne(['confirm' => $token]);
            if (!$user) {
                return $this->redirect(Url::toRoute(['site/fail_confirm']));
            }

           // $user->confirm = null;
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            $ref=User::findOne($user->referal_id);
            if($ref)
            {
                $ref->register_count++;
                $ref->save();
            }


            $this->layout='land';
            return $this->render('confirmed',['user'=>$user]);

        } catch (\Exception $e) {
            Yii::$app->errorHandler->logException($e);
            return $this->redirect(Url::toRoute(['site/fail_confirm']));
        }


    }

    public function actionSuccess_registration()
    {
       return $this->render('success_registration');
    }

    public function actionSuccess_recover()
    {
        return $this->render('success_recover');
    }

    public function actionSuccess_recover2()
    {
        return $this->render('success_recover2');
    }

    public function actionSuccess()
    {

        return $this->render('success');
    }

    public function actionFail()
    {
        return $this->render('fail');
    }

    public function actionFail_confirm()
    {
        return $this->render('fail_confirm');
    }

    public function actionRecover()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = new RecoverForm();
        if ($model->load(Yii::$app->request->post())&&$model->recover()) {
            return $this->redirect('/site/success_recover');
        } else {
            return $this->render('recover', [
                'model' => $model,
            ]);
        }
    }

    public function actionRecover2($confirm)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $user=User::find()->where(['confirm'=>$confirm])->one();
        if(!$user)
            return $this->redirect('/');

        if (isset($_POST['password'])) {
            $user->confirm=null;
            $user->setPassword($_POST['password']);
            $user->generateAuthKey();
            $user->save();
            return $this->redirect('/site/success_recover2');
        } else {
            return $this->render('recover2', [
                'user' => $user,
            ]);
        }
    }



    public function actionR()
    {
        if(isset($_GET['id']))
        {
            setcookie('rpis',$_GET['id'],time()+60*60*24*30,'/');
        }

        if (Yii::$app->user->isGuest)
            return $this->redirect(Url::to(['site/registration']));
        else
            return $this->redirect(Url::to(['site/index']));
        //return $this->render('index');
    }


    public function actionOpen()
    {
        $a=new Open();
        $a->date=date('Y-m-d H:i:s');
        $a->page='open';
        $a->type='view';
        $a->save();

        $this->layout='land';
        return $this->render('open',['id'=>'open']);
    }

}
