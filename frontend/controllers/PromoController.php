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
class PromoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
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







    public function actionIndex($id)
    {
        $a=new Open();
        $a->date=date('Y-m-d H:i:s');
        $a->page=$id;
        $a->type='view';
        $a->save();

        $this->layout='land';
        return $this->render('//site/open',['id'=>$id]);
    }

}
