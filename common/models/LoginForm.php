<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => 'Обязательное поле'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user)
                $this->addError($attribute, 'Неверный пароль');
            else {
                if ($user->status === User::STATUS_WAIT) {
                    $this->addError($attribute, 'Вы не завершили регистрацию. Подтвердите свой Email');
                }
                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Неверный пароль');
                } elseif ($user->status === User::STATUS_ACTIVE) {
                    return Yii::$app->user->login($user, 3600 * 24 * 30 );
                }
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(),  3600 * 24 * 30);
        } else {
            return false;
        }
    }

    public function loginAdm()
    {
        if ($this->validate()) {
            $u=$this->getUser();
            if($u->role=='admin'||$u->role=='support')
                return Yii::$app->user->login($this->getUser(),  3600 * 24 * 30);
            else
                return false;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
