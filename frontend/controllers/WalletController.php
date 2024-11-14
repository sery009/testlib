<?php
namespace frontend\controllers;


use common\models\BtcRates;
use common\models\Matrix;
use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Rate;
use common\models\Reports;
use common\models\Request;
use common\models\RoubleTransactions;
use common\models\Transfer;
use Composer\Config;
use Mpdf\Tag\U;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\UploadedFile;
class WalletController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->layout='user';
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','rate','request','transfer','rouble','open_level','confirm','info','cancel'],
                'rules' => [
                    [
                        'actions' => ['index','rate','request','transfer','rouble','open_level','confirm','info','cancel'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionConfirm()
    {
        if($_POST['id'])
        {
            $rt=RoubleTransactions::findOne($_POST['id']);
            $rt->confirmCashalot();
            //$rt->confirmPayment();
        }
    }

    public function actionCancel($id)
    {

            $rt=RoubleTransactions::findOne($id);
            $rt->status='canceled';
            $rt->save();

    }

    public function actionIndex()
    {
        Yii::$app->user->identity->checkHold(1,3);
        return $this->render('index',['user'=>Yii::$app->user->identity]);
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    public function actionRouble()
    {
        $sum=preg_replace("/[^0-9]/",'',$_POST['sum_rub']);

        if($sum>=1000)
        {
            $a=new RoubleTransactions();
            $a->date=date('Y-m-d H:i:s');
            $a->bank=$_GET['bank'];
            $a->user_id=Yii::$app->user->id;
            $a->sum=$sum;
            $a->sum_with_com=$a->sum*1.075;
            $a->status='new';

            $a->save();


            $aa=new Request();
            $aa->user_id=$a->user_id;
            $aa->status=$a->status;
            $aa->external_id=$a->id;
            $aa->type='add';
            $aa->date=date('Y-m-d H:i:s');
            $aa->sum_rub=$a->sum;
            $aa->save();

            $res=$a->createCashalotPayment();
            return ($res);
        }
        else
        {
            //$a->status='error';
            //$a->save();
        }
        return $this->renderPartial('_finana',['model'=>$a]);
    }

    public function actionRate()
    {
        $rate=new BtcRates();
        $rate->user_id=Yii::$app->user->id;
        $rate->sum_usd=preg_replace("/[^0-9\.]/",'', $_POST['sum_usd']);
        $rate->sum_rub=preg_replace("/[^0-9\.]/",'',$_POST['sum_rub']);
        $rate->status='new';
        $rate->date=date('Y-m-d H:i:s');
        $rate->save();

        $a=new Request();
        $a->user_id=$rate->user_id;
        $a->status='new';
        $a->external_id=$rate->id;
        $a->type='add_usdt';
        $a->date=$rate->date;
        $a->sum_rub=$rate->sum_rub;
        $a->save();
    }

    public function actionRequest()
    {
        if(!$_POST['type'])
            return json_encode(['error'=>'Ошибка. Не выбран метод выплаты']);
        if($_POST['type']=='rub'&&!$_POST['address2'])
            return json_encode(['error'=>'Ошибка. Не указана банковская карта']);
        if($_POST['type']=='rub'&&!$_POST['fio'])
            return json_encode(['error'=>'Ошибка. Не указано ФИО']);
        if($_POST['type']=='usdt'&&!$_POST['address'])
            return json_encode(['error'=>'Ошибка. Не указан кошелек']);

        if(isset($_POST['sum_rub']))
        {
            $sum_rub=preg_replace("/[^0-9]/",'',$_POST['sum_rub']);
            if($sum_rub<1080)
                return json_encode(['error'=>'Минимальная сумма 1080 руб']);
        }

        if(isset($_POST['sum_rub'])&&$_POST['sum_rub']>0)
        {
            $u=Yii::$app->user->identity;
            $sum_rub=preg_replace("/[^0-9]/",'',$_POST['sum_rub']);
            if($sum_rub<1000)
            {
                return json_encode(['error'=>'Минимальная сумма вывода 1000 руб']);
            }
            elseif($u->balance>=$sum_rub)
            {
                $mr=new Moneyrequest();
                $mr->user_id=$u->id;
                $mr->status='new';
                $mr->date=date('Y-m-d H:i:s');

                $mr->type=$_POST['type'];
                if($mr->type=='rub')
                {
                    $mr->address=$_POST['address2'];
                    $mr->fio=$_POST['fio'];
                    $mr->bank=$_POST['bank'];
                }
                else
                    $mr->address=$_POST['address'];
                $mr->sum_rub=$sum_rub;
                $mr->sum_with_com=$sum_rub*0.935;
                $mr->sum_usd=$sum_rub/(\common\models\Config::getRateForOutcome());
                $mr->report_id=0;
                $mr->save();

                $report=new Reports();
                $report->from=$u->id;
                $report->to=$u->id;
                $report->type='moneyrequest';
                $report->sum_rub=$sum_rub;
                $report->date=date('Y-m-d H:i:s');
                $report->status='new';
                $report->external_id=$mr->id;
                $report->save();

                $mr->report_id=$report->id;
                $mr->save();
                $u->balance-=$sum_rub;
                $u->save();

                $a=new Request();
                $a->user_id=$mr->user_id;
                $a->status=$mr->status;
                $a->external_id=$mr->id;
                $a->type='moneyrequest';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum_rub;
                $a->save();

                $message='Заявка на вывод '.$mr->sum_with_com.' руб';
                if($mr->type=='rub')
                {
                    $message='Заявка на вывод '.$sum_rub.' руб';
                }
                $message.="\r\nПользователь ".$u->getConcatened4();
                file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-1001735033513');
//                if($mr->type=='rub')
//                {
//                    $message='Заявка на вывод '.$sum_rub.' руб';
//                    $message.="\r\nПользователь ".$u->getConcatened4();
//                    $message.="\r\nНомер карты ".$mr->address;
//                    $message.="\r\nФИО ".$mr->fio;
//                    $message.="\r\nБанк ".$mr->bank;
//                    file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-4555824412');
//                }

                return json_encode(['success'=>'Заявка на вывод отправлена']);
            }
            else
                return json_encode(['error'=>'Суммы на счете недостаточно']);
        }
        return json_encode(['error'=>'Ошибка']);
    }

    public function actionTransfer()
    {
        if(isset($_POST['sum_rub'])&&$_POST['sum_rub']>0)
        {
            $u=Yii::$app->user->identity;
            $to=User::find()->where(['nick'=>$_POST['to']])->orWhere(['email'=>$_POST['to']])->one();
            $sum_rub=preg_replace("/[^0-9]/",'',$_POST['sum_rub']);
            if(!$to)
            {
                return json_encode(['error'=>'Пользователь не найден']);
            }
            elseif($u->balance>=$sum_rub)
            {
                $mr=new Transfer();
                $mr->user_id=$u->id;
                $mr->date=date('Y-m-d H:i:s');
                $mr->sum_rub=$sum_rub;
                $mr->report_id=0;
                $mr->save();

                $report=new Reports();
                $report->from=$u->id;
                $report->to=$to->id;
                $report->type='transfer_send';
                $report->sum_rub=-$sum_rub;
                $report->date=date('Y-m-d H:i:s');
                $report->status='new';
                $report->external_id=$mr->id;
                $report->save();

                $report=new Reports();
                $report->from=$u->id;
                $report->to=$to->id;
                $report->type='transfer_get';
                $report->sum_rub=$sum_rub;
                $report->date=date('Y-m-d H:i:s');
                $report->status='new';
                $report->external_id=$mr->id;
                $report->save();

                $mr->report_id=$report->id;
                $mr->save();
                $u->balance-=$sum_rub;
                $u->save();

                $to->balance+=$sum_rub;
                $to->save();

                $a=new Request();
                $a->user_id=$mr->user_id;
                $a->status='success';
                $a->external_id=$mr->id;
                $a->type='transfer';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum_rub;
                $a->save();

                $message='Перевод '.$sum_rub.' руб';
                $message.="\r\nОт пользователя ".$u->getConcatened4();
                $message.="\r\nПользователю ".$to->getConcatened4();
                file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-1001789973142');

                return json_encode(['success'=>'Перевод отправлен']);
            }
            else
                return json_encode(['error'=>'Суммы на счете недостаточно']);
        }
        return json_encode(['error'=>'Ошибка']);
    }

    public function actionOpen_level($id)
    {
        if(strtotime('now')<strtotime(\common\models\Config::$DATES[$id]))
            return $this->redirect(['learn/index']);
        $user=Yii::$app->user->identity;
        $price=\common\models\Config::$LEVELS[$id];
        if(Matrix::find()->where(['level'=>$id,'user_id'=>$user->id])->one())
            return $this->redirect(['learn/index']);
        if($user->balance<$price||$price<=0)
            return $this->redirect(['wallet/index']);

        if(Matrix::find()->where(['user_id'=>$user->id])->andWhere(['<','level',$id])->count()<($id-1))
        {
            return $this->redirect(['learn/index']);
        }


        $report=new Reports();
        $report->from=$user->id;
        $report->to=$user->id;
        $report->type='buy';
        $report->sum_rub=-$price;
        $report->date=date('Y-m-d H:i:s');
        $report->status='success';
        $report->external_id=0;
        $report->save();

        $user->balance-=$price;
        $user->save();

        $user->findPlace($id);

        $user->addComToUsers($id);
        $user->unlockReferal($id);
        Yii::$app->session->setFlash('success','Успешно');
        $message='Покупка раунда пользователем: '.$user->getConcatened2();
        file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-4563470594');
        return $this->redirect(['rounds/index']);
    }

    public function actionInfo()
    {
        $request=Request::findOne($_POST['id']);
        return $this->renderPartial('_info',['request'=>$request]);
    }

    public function actionBuy_promo($id)
    {
        $user=Yii::$app->user->identity;
        $price=\common\models\Config::$LEVELS[$id];

        if($user->balance<$price||$price<=0)
            return $this->redirect(['wallet/index']);

        $u = new User();
        $u->generateAuthKey();
        $password=uniqid();
        $u->setPassword($password);
        $u->email = "";
        $u->name = "";
        $u->nick = "";
        $u->promocode=uniqid();

        $u->referal_id = $user->id;
        $u->confirm = Yii::$app->security->generateRandomString();
        $u->status = User::STATUS_PROMO;
        $u->phone='';
        $u->phone_r='';
        $u->role='user';
        $u->created_at=time();
        $u->register_date=date('Y-m-d H:i:s');
        $u->save();



        $report=new Reports();
        $report->from=$user->id;
        $report->to=$user->id;
        $report->type='buy';
        $report->sum_rub=-$price;
        $report->date=date('Y-m-d H:i:s');
        $report->status='success';
        $report->external_id=0;
        $report->save();

        $user->balance-=$price;
        $user->save();

        $u->findPlace($id);

        $u->addComToUsers($id);
        $u->unlockReferal($id);
        Yii::$app->session->setFlash('success','Вы успешно приобрели промокод');


        $message='Покупка промокода пользователем: '.$user->getConcatened2();
        file_get_contents('https://api.telegram.org/bot'. \common\models\Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-4563470594');

        return $this->redirect(['referals/index']);
    }
}