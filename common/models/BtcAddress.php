<?php

namespace common\models;

use Yii;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Api\Address;
use BlockCypher\Api\WebHook;
/**
 * This is the model class for table "btc_address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 */
class BtcAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'btc_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address'], 'safe'],
            [['user_id'], 'integer'],
            [['address'], 'string', 'max' => 50],
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
            'address' => 'Address',
        ];
    }


    private $btc_rate;
}
