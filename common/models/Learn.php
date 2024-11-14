<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "learn".
 *
 * @property int $id
 * @property string $video
 * @property int $level
 * @property string $description
 * @property string $name
 * @property string $image
 */
class Learn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video', 'level', 'description','name','image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video' => 'Video',
            'level' => 'Level',
            'description' => 'Description',
        ];
    }
}
