<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nick;
    public $email;
    public $password;
    public $password2;
    public $telegram;
    public $referal_id;
    public $promocode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         //   ['phone', 'trim'],
         //   ['phone', 'required', 'message' => 'Обязательное поле'],
         //   ['name', 'required', 'message' => 'Обязательное поле'],
         //   ['password', 'required', 'message' => 'Обязательное поле'],
         //   ['password2', 'required', 'message' => 'Обязательное поле'],
        //    ['phone', 'string', 'min' => 2, 'max' => 255],

            ['telegram', 'trim'],
            ['promocode', 'trim'],
         //   ['telegram', 'required', 'message' => 'Обязательное поле'],


            ['email', 'trim'],
            ['email', 'required', 'message' => 'Обязательное поле'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['password2','safe'],
            ['nick','safe'],
            ['referal_id','safe'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данный Email уже используется'],
            ['password', function ($attribute, $params) {
                if ($this->password!=$this->password2) {
                    $this->addError($attribute, 'Пароли не совпадают');
                }
            }],
            ['promocode', function ($attribute, $params) {
                if($this->promocode)
                {
                    $cnt=User::find()->where(['status'=>User::STATUS_PROMO,'promocode'=>$this->promocode])->count();
                    if (!$cnt) {
                        $this->addError($attribute, 'Неверный промокод');
                    }
                }

            }],
        ];
    }


}
