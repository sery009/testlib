<?php
namespace frontend\controllers;


use common\models\BtcRates;
use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Rate;
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
class InfoController extends Controller
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
                'only' => ['index','start','work','earn','income','faq','mail','what'],
                'rules' => [
                    [
                        'actions' => ['index','start','work','earn','income','faq','mail','what'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionFaq()
    {
        return $this->render('faq',['user'=>Yii::$app->user->identity]);
    }

    public function actionWhat()
    {
        return $this->render('what',['user'=>Yii::$app->user->identity]);
    }

    public function actionIncome()
    {
        return $this->render('income',['user'=>Yii::$app->user->identity]);
    }

    public function actionEarn()
    {
        return $this->render('earn',['user'=>Yii::$app->user->identity]);
    }

    public function actionWork()
    {
        return $this->render('work',['user'=>Yii::$app->user->identity]);
    }

    public function actionIndex()
    {
        return $this->render('index',['user'=>Yii::$app->user->identity]);
    }

    public function actionStart()
    {
        return $this->render('start',['user'=>Yii::$app->user->identity]);
    }

    public function actionMail()
    {
        return $this->render('mail',['user'=>Yii::$app->user->identity]);
    }


    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }




}