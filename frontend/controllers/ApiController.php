<?php
namespace frontend\controllers;

use common\models\BtcAddress;
use common\models\CarBrand;
use common\models\CarModel;
use common\models\Config;
use common\models\Invest;
use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Program;
use common\models\Rate;
use common\models\RecoverForm;
use common\models\TempMoneyrequest;
use common\models\TempUsers;
use common\models\TicketMessages;
use common\models\Tickets;
use common\models\User;

use Yii;
use yii\base\InvalidParamException;
use yii\db\Exception;
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
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['telegram_login','telegram_balance','telegram_link','telegram_hold'],
                'rules' => [
                    [
                        'actions' => ['telegram_login','telegram_balance','telegram_link','telegram_hold'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['telegram_login','telegram_balance','telegram_link','telegram_hold'],
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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
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



    public function actionTelegram_login()
    {
        if(isset($_GET['email'])&&$_GET['email'])
        {
            $u=User::find()->where(['email'=>$_GET['email']])->one();

            if($u&&$u->status==User::STATUS_ACTIVE&&$u->validatePassword($_GET['password']))
                return [
                    'token'=>$u->id,
                    'user_id'=>$u->id,
                    'reg_step'=>'',
                    'temp'=>0
                ];
            else
            {
                return ['error_code'=>1,'error_text'=>'Неверный логин пароль'];
            }
        }
        else
        {
            return ['error_code'=>1,'error_text'=>'Нет Email'];
        }
    }



    public function actionTelegram_balance($token)
    {
        $user=User::findOne($token);
        if($user)
        {
            return [
                'sum'=>$user->balance,
            ];
        }
        else
        {
            return ['error_code'=>2,'error_text'=>'Неверный токен'];
        }
    }

    public function actionTelegram_hold($token)
    {
        $user=User::findOne($token);
        if($user)
        {
            return [
                'sum'=>intval(\common\models\Reports::find()->where(['hold'=>1,'to'=>$user->id])->sum('sum_rub')),
            ];
        }
        else
        {
            return ['error_code'=>2,'error_text'=>'Неверный токен'];
        }
    }

    public function actionTelegram_link($token)
    {
        $user=User::findOne($token);
        if($user)
        {
            return [
                'link'=>Url::to(['site/r','id'=>$user->id],true),
            ];
        }
        else
        {
            return ['error_code'=>2,'error_text'=>'Неверный токен'];
        }
    }



}
