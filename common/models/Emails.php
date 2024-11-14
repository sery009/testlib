<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emails".
 *
 * @property int $id
 * @property string $email
 * @property string $content
 * @property string $date
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'content', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'content' => 'Content',
            'date' => 'Date',
        ];
    }
}
