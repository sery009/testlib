<?php

namespace common\services\auth;

use common\models\Config;
use Yii;
use common\models\User;
use common\models\Settings;
use frontend\models\SignupForm;
use yii\db\Exception;

class SignupService
{

    public function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function signup(SignupForm $form)
    {
        //$password=$this->generateRandomString(8);
        if($form->promocode)
        {
            $user=User::find()->where(['status'=>User::STATUS_PROMO,'promocode'=>$form->promocode])->one();
            $user->status = User::STATUS_ACTIVE;
        }
        if(!$user)
        {
            $user = new User();
            $user->referal_id = $form->referal_id?$form->referal_id:1;
            $user->status = User::STATUS_WAIT;
        }
        $user->generateAuthKey();
        $user->setPassword($form->password);
        $user->email = $form->email;
        $user->name = $form->nick;
        $user->nick = $form->nick;
        $user->telegram = $form->telegram?$form->telegram:'';



        $user->confirm = Yii::$app->security->generateRandomString();

        $user->phone='';
       // $user->phone_r=preg_replace('/[^0-9]/', '', $form->phone);
        $user->role='user';
        $user->created_at=time();
        $user->register_date=date('Y-m-d H:i:s');

        if(!$user->save()){
            throw new \RuntimeException('Saving error.');
        }

        $message='Зарегистрирован новый пользователь '.$user->getConcatened2();
        $ref=User::findOne($user->referal_id);
        if($ref)
            $message.="\r\nПригласитель: ".$ref->getConcatened4();
        file_get_contents('https://api.telegram.org/bot'.Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-683895913');


        return $user;
    }


    public function sentEmailConfirm(User $user,$password)
    {
        $email = $user->email;
        try{
            $sent=Config::sendMessage('user-signup-comfirm-html',['user' => $user,'password'=>$password],$email,'Подтверждение регистрации');
            if (!$sent) {
                throw new \RuntimeException('Sending error.');
            }
        }
        catch (Exception $e)
        {}

    }


    public function confirmation($token)
    {
        if (empty($token)) {
            throw new \DomainException('Неверный адрес');
        }

        $user = User::findOne(['confirm' => $token]);
        if (!$user) {
            throw new \DomainException('Пользователь не найден');
        }

        $user->confirm = null;
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        if (!Yii::$app->getUser()->login($user)){
            throw new \RuntimeException('Ошибка');
        }
        return $user;
    }

}