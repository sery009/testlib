<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "matrix1".
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property int $parent_user_id
 * @property int $level
 * @property int $line
 * @property string $position
 * @property string $date
 */
class Matrix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matrix';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'parent_user_id', 'position','user_id','level','date','line'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'parent_user_id' => 'Parent User ID',
            'position' => 'Position',
        ];
    }

    public function countUsersInLine($line)
    {
        $ids=[];
        if($line==1)
            return count(self::find()->where(['parent_id'=>$this->id])->orderBy(['position'=>SORT_ASC])->all());
        else
        {
            $ids[]=$this->id;
            for($i=0;$i<$line;$i++)
            {
                $matrixes=self::find()->where(['in','parent_id',$ids])->orderBy(['position'=>SORT_ASC])->all();
                $ids=[];
                if($matrixes)
                {
                    foreach ($matrixes as $m)
                    {
                        $ids[]=$m->id;
                    }
                }
            }
            return  count($ids);

        }
    }



    public static $POSITION_LEFT='a_left';
    public static $POSITION_CENTER='b_center';
    public static $POSITION_RIGHT='c_right';

    public $cnt;
}
