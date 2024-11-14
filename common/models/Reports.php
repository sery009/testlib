<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property string $type
 * @property string $sum_rub
 * @property string $date
 * @property string $status
 * @property int $external_id
 * @property int $line
 * @property int $hold
 * @property int $level
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'type', 'sum_rub', 'date', 'status', 'external_id','line','hold','level'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'Кому',
            'toUser' => 'Кому',
            'type' => 'Type',
            'type_name' => 'Тип операции',
            'sum_rub' => 'Sum Rub',
            'date' => 'Date',
            'status' => 'Status',
            'external_id' => 'External ID',
        ];
    }


    public function getToUser()
    {
        $u=User::findOne($this->to);
        if($u)
        return $u->getConcatened2();
    }
}
