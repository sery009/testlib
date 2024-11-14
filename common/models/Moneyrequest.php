<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "moneyrequest".
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $sum_rub
 * @property string $sum_usd
 * @property string $status
 * @property string $date
 * @property string $report_id
 * @property string $type
 * @property string $fio
 * @property string $bank
 * @property string $sum_with_com
 */
class Moneyrequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moneyrequest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'],'required'],
            [['user_id', 'address', 'sum_usd', 'status', 'date'], 'safe'],
            [['user_id'], 'safe'],
            [['address'], 'safe'],
            [['sum_rub'], 'safe'],
            [['date'], 'safe'],
            [['report_id'], 'safe'],
            [['status'], 'safe'],
            [['sum_usd'], 'safe'],
            [['type'], 'safe'],
            [['fio'], 'safe'],
            [['bank'], 'safe'],
            [['sum_with_com'], 'safe'],

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
            'address' => 'Кошелек',
            'sum_rub' => 'Сумма, руб',
            'sum_btc' => 'Сумма, BTC',
            'status' => 'Status',
            'date' => 'Дата',
            'can_moneyrequest' => 'Может вывести',
            'can_moneyrequest2' => 'Может вывести',
            'confirm' => 'Подтвердить',
            'cancel' => 'Отменить',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {

            }
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return User::findOne($this->user_id)->concatened4;
    }

    public function getCan_moneyrequest()
    {
        if($this->status=='new')
            return true;
        return false;

    }
    public function getCan_moneyrequest2()
    {
        if($this->can_moneyrequest)
            return'Да';
        return'Нет';
    }

    public function getConfirm()
    {
        if($this->can_moneyrequest)
            return'<a class="confirm_confirm" href="'.Url::to(['moneyrequest/confirm','id'=>$this->id]).'">Подтвердить</a>';
        else
            return '';
    }

    public function getCancel()
    {
        if($this->can_moneyrequest)
            return'<a class="confirm_cancel" href="'.Url::to(['moneyrequest/cancel','id'=>$this->id]).'">Отменить</a>';
        else
            return '';
    }


}
