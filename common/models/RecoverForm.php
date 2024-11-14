<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class RecoverForm extends Model
{
    public $email;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required', 'message' => 'Обязательное поле'],

        ];
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function recover()
    {
        if ($this->validate()) {
            $user=$this->getUser();
            if(!$user)
            {
                $this->addError('email', 'Неверный Email');
                return  false;
            }
            else
            {
                $user->recover();
                return  true;
            }
        } else {
            return false;
        }
    }


    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
