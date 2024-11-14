<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "btc_rates".
 *
 * @property int $id
 * @property int $user_id
 * @property string $sum_rub
 * @property string $sum_usd
 * @property string $status
 * @property string $date
 */
class BtcRates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'btc_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sum_rub', 'sum_usd', 'status', 'date'], 'safe'],
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
            'sum_lgm' => 'Sum Lgm',
            'sum_rgm' => 'Sum Rgm',
            'sum_btc' => 'Sum Btc',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
