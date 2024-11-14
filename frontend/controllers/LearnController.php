<?php
namespace frontend\controllers;


use common\models\Learn;
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
class LearnController extends Controller
{
    public function beforeAction($action)
    {
        $this->layout='user';
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view'],
                'rules' => [
                    [
                        'actions' => ['index','view'],
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

    private function findModel($id)
    {
        return Learn::findOne($id);
    }

    public function actionView($id)
    {
        $model=$this->findModel($id);
        $user=Yii::$app->user->identity;
        if(!$user->isLevelOpen($model->level))
            return $this->redirect(['learn/index']);
        return $this->render('view',['user'=>Yii::$app->user->identity,'model'=>$model]);
    }


}