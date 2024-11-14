<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "btc_transactions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property string $sum_btc
 * @property string $sum_rub
 * @property string $date
 * @property string $height
 * @property int $tx_output_n
 * @property string $address
 * @property string $sum_usd
 */
class BtcTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'btc_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'hash', 'sum_btc', 'sum_rub', 'date', 'height', 'tx_output_n', 'address','sum_usd'], 'safe'],
            [['user_id', 'tx_output_n'], 'integer'],
            [['sum_btc', 'sum_rub'], 'number'],
            [['date'], 'safe'],
            [['address'], 'string'],
            [['hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'Пользователь',
            'hash' => 'Hash',
            'sum_btc' => 'Сумма, BTC',
            'sum_rub' => 'Сумма, руб',
            'date' => 'Дата',
            'height' => 'Height',
            'tx_output_n' => 'Tx Output N',
            'address' => 'Кошелек',
        ];
    }

    public function getUser()
    {
        return User::findOne($this->user_id)->concatened;
    }
}
