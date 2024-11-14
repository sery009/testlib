<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usdt_transactions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $transaction_id
 * @property string $sum_usd
 * @property string $address
 * @property string $sum_rub
 * @property string $date
 */
class UsdtTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usdt_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'transaction_id', 'sum_usd', 'address', 'sum_rub'], 'required'],
            [['user_id'], 'integer'],
            [['transaction_id', 'address'], 'string'],
            [['sum_usd', 'sum_rub'], 'number'],
            [['date'], 'safe'],
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
            'transaction_id' => 'Transaction ID',
            'sum_usd' => 'Sum Usd',
            'address' => 'Address',
            'sum_rub' => 'Sum Rub',
        ];
    }

    public function getUserData()
    {
        return User::findOne($this->user_id)->getConcatened4();
    }
}
