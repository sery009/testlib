<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property string $sum_rub
 * @property string $type
 * @property int $external_id
 * @property string $date
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'sum_rub', 'type', 'external_id', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'sum_rub' => 'Sum Rub',
            'type' => 'Type',
            'external_id' => 'External ID',
            'date' => 'Date',
        ];
    }

    public static function generate()
    {
        /*$mrs=Transfer::find()->where(1)->all();
        if($mrs)
        {
            foreach ($mrs as $mr)
            {
                $a=new self();
                $a->user_id=$mr->user_id;
                $a->status='success';
                $a->external_id=$mr->id;
                $a->type='transfer';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum_rub;
                $a->save();
            }
        }*/
        /*$mrs=BtcRates::find()->where(1)->all();
        if($mrs)
        {
            foreach ($mrs as $mr)
            {
                $a=new self();
                $a->user_id=$mr->user_id;
                $a->status=$mr->status;
                $a->external_id=$mr->id;
                $a->type='add_usdt';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum_rub;
                $a->save();
            }
        }*/
        /*
        $mrs=Moneyrequest::find()->where(1)->all();
        if($mrs)
        {
            foreach ($mrs as $mr)
            {
                $a=new self();
                $a->user_id=$mr->user_id;
                $a->status=$mr->status;
                $a->external_id=$mr->id;
                $a->type='moneyrequest';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum_rub;
                $a->save();
            }
        }

        $mrs=RoubleTransactions::find()->where(1)->all();
        if($mrs)
        {
            foreach ($mrs as $mr)
            {
                $a=new self();
                $a->user_id=$mr->user_id;
                $a->status=$mr->status;
                $a->external_id=$mr->id;
                $a->type='add';
                $a->date=$mr->date;
                $a->sum_rub=$mr->sum;
                $a->save();
            }
        }*/
    }
}
