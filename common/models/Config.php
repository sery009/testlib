<?php
namespace common\models;
use Yii;
class Config
{
    public static $bot_api_key='***';
    public static $CASHALOT_API_BASE_URL='***';
    public static $CASHALOT_API_KEY= '***';
    public static $CASHALOT_SECRET_KEY='***';

    //public static $bot_api_key='';
    public static function sendMessage($html_template,$params,$to,$subject)
    {
        $message=Yii::$app->mailer->render($html_template,$params);
        $em=new Emails();
        $em->email=$to;
        $em->content=$message;
        $em->date=date('Y-m-d H:i:s');
        $em->save();
        return Yii::$app->mailer
            ->compose(
                ['html' => $html_template],
                $params)
            ->setFrom('noreply@libertygame.ru')
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }


    public static function generatePassword($length=8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getRateForIncome()
    {
        return self::getBinanceRate()/1.075;
        return self::GetCurentKursDolarsSber()/1.075;
    }

    public static function getRateForOutcome()
    {
        return self::getBinanceRate()*1.035;
        return self::GetCurentKursDolarsSber()*1.035;
    }


    public static function GetCurentKursDolarsSber(){
        $d=self::CBR_XML_Daily_Ru();
        return $d->Valute->USD->Value;
    }

    public function getBinanceRate()
    {
        $a=file_get_contents('https://api.binance.com/api/v3/ticker/price?symbol=USDTRUB');
        if(!$a)
            return self::GetCurentKursDolarsSber();
        $dec=json_decode($a,true);
        return $dec['price'];
    }

    public static function CBR_XML_Daily_Ru() {
        $json_daily_file = __DIR__.'/daily.json';
        if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
            if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
                file_put_contents($json_daily_file, $json_daily);
            }
        }

        return json_decode(file_get_contents($json_daily_file));
    }

    public static function places($place)
    {
        if($place==1)
            return 50000;
        elseif($place==2)
            return 30000;
        elseif($place==3)
            return 20000;
        elseif($place==4||$place==5)
            return 10000;
        elseif($place>=6&&$place<=10)
            return 5000;
        elseif($place>=11&&$place<=20)
            return 2000;
        elseif($place>=21&&$place<=50)
            return 1000;
        elseif($place>=51&&$place<=100)
            return 500;
    }


    public static $LEVELS=[
        1=>1000,
        //2=>2000,
        //3=>3000,
        //4=>4000,
        //5=>5000,
        //6=>7000,
        //7=>9000,
        //8=>11000,
        //9=>13000,
        //10=>15000,
        //11=>18000,
        //12=>21000,
        //13=>24000,
        //14=>27000,
        //15=>30000,
    ];

    public static $percents=[
        1=>0.4,
        2=>0.1,
        3=>0.1,
        4=>0.1,
        5=>0.1,
        6=>0.1,
    ];

    public static  function declension($value = 1, $wordForms = ['товар', 'товара', 'товаров'])
    {
        $array = [2,0,1,1,1,2];
        return $wordForms[($value%100>4&&$value%100<20)?2:$array[($value%10<5)?$value%10:5]];
    }

    public static $DATES=[
         1=>'2022-12-06 16:00:00',
         2=>'2022-12-31 16:00:00',
         3=>'2022-12-31 16:00:00',
         4=>'2022-12-31 16:00:00',
         5=>'2022-12-31 16:00:00',
         6=>'2022-12-31 16:00:00',
         7=>'2022-12-31 16:00:00',
         8=>'2022-12-31 16:00:00',
         9=>'2022-12-31 16:00:00',
        10=>'2022-12-31 16:00:00',
        11=>'2022-12-31 16:00:00',
        12=>'2022-12-31 16:00:00',
        13=>'2022-12-31 16:00:00',
        14=>'2022-12-31 16:00:00',
        15=>'2022-12-31 16:00:00',
    ];
}
