<?php
namespace common\models;
use Yii;
class Round
{
    public $level;
    public function __construct($level)
    {
        $this->level=$level;
    }

    public function getTotal()
    {
        return Matrix::find()->where(['level'=>$this->level])->count();
    }

    public function getMyReferals()
    {
        return Matrix::find()->where(['level'=>$this->level,'parent_user_id'=>Yii::$app->user->id])->count();
    }

    public function getDohod()
    {
        return intval(Reports::find()->where(['to'=>Yii::$app->user->id,'hold'=>0,'level'=>$this->level])->sum('sum_rub'));
    }

    public function getHold()
    {
        return intval(Reports::find()->where(['to'=>Yii::$app->user->id,'hold'=>1,'level'=>$this->level])->sum('sum_rub'));
    }
}