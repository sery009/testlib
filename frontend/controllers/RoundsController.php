<?php
namespace frontend\controllers;


use common\models\Moneyrequest;
use common\models\Notifications;
use common\models\Rate;
use common\models\Round;
use Composer\Config;
use Matrix\Matrix;
use Mpdf\Tag\U;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\UploadedFile;
class RoundsController extends Controller
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
                'only' => ['index','view','info','modal'],
                'rules' => [
                    [
                        'actions' => ['index','view','info','modal'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user=Yii::$app->user->identity;
        $id=1;
        $round=new Round($id);
        return $this->render('view',['user'=>$user,'level'=>$id,'round'=>$round]);
        return $this->render('index',['user'=>Yii::$app->user->identity]);
    }

    public function actionView($id)
    {
        $user=Yii::$app->user->identity;
        //if(!$user->isLevelOpen($id))
        //{
        //    return $this->redirect(['rounds/index']);
        //}
        $round=new Round($id);
        return $this->render('view',['user'=>$user,'level'=>$id,'round'=>$round]);
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    public function actionInfo()
    {
        return $this->renderPartial('_view',['not_show'=>$_GET['not_show'],'line'=>$_GET['line']+1,'user'=>Yii::$app->user->identity,'first'=>\common\models\Matrix::findOne($_GET['first']),'current'=>\common\models\Matrix::findOne($_GET['id'])]);
    }

    public function actionModal()
    {
        return $this->renderPartial('_modal',['user'=>Yii::$app->user->identity,'matrix'=>\common\models\Matrix::findOne($_GET['id'])]);
    }


}