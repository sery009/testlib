<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "open".
 *
 * @property int $id
 * @property string $page
 * @property string $name
 * @property string $phone
 * @property string $type
 * @property string $date
 */
class Open extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'open';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page', 'name', 'phone', 'type', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'name' => 'Name',
            'phone' => 'Phone',
            'type' => 'Type',
            'date' => 'Date',
        ];
    }
}
