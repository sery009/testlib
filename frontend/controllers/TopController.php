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
class TopController extends Controller
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
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }



    public function actionIndex()
    {
        return $this->render('index',['user'=>Yii::$app->user->identity]);
    }



    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }




}