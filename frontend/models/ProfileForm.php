<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ProfileForm extends Model
{
    public $name;
    public $second_name;
    public $last_name;
    public $email;
    public $phone;

    public $postcode;
    public $city;
    public $street;
    public $house;
    public $appartment;

    public function rules()
    {
        return [

            [['name','second_name','phone','email','postcode','city','house','appartment','street'], 'required','message'=>'Заполните {attribute}'],
            [['last_name'], 'safe'],

        ];
    }

    public function init()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());

        $this->name = $user->name;
        $this->second_name = $user->second_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->postcode = $user->postcode;
        $this->city = $user->city;
        $this->street = $user->street;
        $this->house = $user->house;
        $this->appartment = $user->appartment;
    }

    public function save_user()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne(Yii::$app->user->identity->getId());

        $user->name = $this->name;
        $user->second_name = $this->second_name;
        $user->last_name = $this->last_name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->postcode = $this->postcode;
        $user->city = $this->city;
        $user->street = $this->street;
        $user->house = $this->house;
        $user->appartment = $this->appartment;
        $user->save();
        return true;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name'=>'Имя',
            'second_name'=>'Фамилия',
            'last_name'=>'Отчество',
            'phone'=>'Мобильный телефон',
            'email'=>'Email',
            'postcode'=>'Индекс',
            'city'=>'Город',
            'street'=>'Улица',
            'house'=>'Дом',
            'appartment'=>'Квартира',
        ];
    }
}