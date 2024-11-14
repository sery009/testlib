<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usdt_wallets".
 *
 * @property int $id
 * @property int $user_id
 * @property string $wallet
 * @property string $private_key
 * @property string $contract_address
 * @property string $date
 * @property int $active
 * @property int $public_key
 */
class UsdtWallets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usdt_wallets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'wallet', 'private_key', 'contract_address', 'active', 'public_key','date'], 'safe'],
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
            'wallet' => 'Wallet',
            'private_key' => 'Private Key',
            'contract_address' => 'Contract Address',
            'active' => 'Active',
            'public_key' => 'Public Key',
        ];
    }
}
