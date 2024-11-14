<?php
namespace frontend\controllers;


use common\models\BtcRates;
use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Rate;
use common\models\Request;
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
class UserController extends Controller
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
                'only' => ['index','check','profile'],
                'rules' => [
                    [
                        'actions' => ['index','check','profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }



    public function actionIndex()
    {
        return $this->redirect(['learn/index']);
        return $this->render('index',['user'=>Yii::$app->user->identity]);
    }

    public function actionProfile()
    {
        if(isset($_POST['User']['pass']))
        {
            $user=Yii::$app->user->identity;
            if(!$_POST['User']['pass'])
            {
                $user->addError('pass',Yii::t('app','Обязательное поле новый пароль'));
                return $this->render('profile',['user'=>$user]);
            }
            if(!$_POST['User']['pass2'])
            {
                $user->addError('pass2',Yii::t('app','Обязательное поле повторить пароль'));
                return $this->render('profile',['user'=>$user]);
            }
            if(!$_POST['User']['pass3'])
            {
                $user->addError('pass3',Yii::t('app','Обязательное поле старый пароль'));
                return $this->render('profile',['user'=>$user]);
            }
            if($_POST['User']['pass']!=$_POST['User']['pass2'])
            {
                $user->addError('pass2',Yii::t('app','Пароли не совпадают'));
                return $this->render('profile',['user'=>$user]);
            }

            if(!$user->validatePassword($_POST['User']['pass3']))
            {
                $user->addError('pass3',Yii::t('app','Неверный старый пароль'));
                return $this->render('profile',['user'=>$user]);
            }
            $user->setPassword($_POST['User']['pass2']);
            $user->generateAuthKey();
            $user->save();
            return $this->redirect(['user/profile']);
        }
        elseif(isset($_POST['User']['telegram']))
        {
            $user=Yii::$app->user->identity;
            $user->telegram=$_POST['User']['telegram'];
            $user->save();
            return $this->redirect(['user/profile']);
        }
        elseif(isset($_POST['User']['inst']))
        {
            $user=Yii::$app->user->identity;
            $user->inst=$_POST['User']['inst'];
            $user->save();
            return $this->redirect(['user/profile']);
        }
        return $this->render('profile',['user'=>Yii::$app->user->identity]);
    }



    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    public function actionCheck()
    {
        /*$users=User::find()->where(['>','id',2])->limit(100)->all();
        foreach ($users as $u)
        {
            $u->findPlace(1);
            $u->addComToUsers(1);
        }*/
        $user=User::findOne(3941);
        for($i=1;$i<=15;$i++)
        $user->unlockReferal($i);
    }


    public function actionMm()
    {
        Request::generate();
    }

}