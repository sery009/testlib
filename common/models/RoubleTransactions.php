<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "rouble_transactions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $sum
 * @property string $sum_with_com
 * @property string $external_id
 * @property string $status
 * @property string $bank
 * @property string $card
 * @property string $result
 * @property string $dispute_sum
 * @property string $dispute_img
 * @property string $dispute_result
 * @property string $link
 * @property string $sum_cashalot
 */
class RoubleTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rouble_transactions';
    }
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sum', 'sum_with_com', 'external_id', 'status','bank','card','result'], 'safe'],
            [['dispute_sum','dispute_img','dispute_result'],'safe'],
            [['link'], 'safe'],
            [['sum_cashalot'], 'safe'],
            [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, gif, png']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sum' => 'Sum',
            'sum_with_com' => 'Sum With Com',
            'external_id' => 'External ID',
            'status' => 'Status',
        ];
    }

//    const API_SECRET='b351abe6ff866c9c792fdb58951a788f72d410e7';
//    const USER_ID=5;
    const API_SECRET='86183773122af3a92534826874fb1936ce2e93f3';
    const USER_ID=8;
    public function generatePayment()
    {
        $data=[
            'user_id'=>self::USER_ID,
            'amount'=>intval($this->sum_with_com),
            'bank_name'=>($this->bank),
            'callback_url'=>Url::to(['site/check_finana','id'=>$this->id],true)
        ];

        $enc_data=json_encode($data,JSON_UNESCAPED_SLASHES);
        $signature=sha1(self::API_SECRET.$enc_data);

        $curl = curl_init();
        $data=$enc_data;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pgapi.biz/v1/p2p_transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Signature: '.$signature,
                'Content-Type: application/json',
        //        'Content-Length: ' . strlen($data),
            ),
        ));


        $response = curl_exec($curl);
        curl_close($curl);


        $dec_response=json_decode($response,true);
        $this->result=$response;
        $this->external_id=$dec_response["payload"]['id'];
        //$this->bank=$dec_response["payload"]['resipient_card']['bank_name'];
        $this->card=$dec_response["payload"]['resipient_card']['number'];
        $this->save();
    }

    public function ccMasking( ) {
        return substr($this->card, 0, 4).' ' . substr($this->card, 4, 4).' ' .substr($this->card, 8, 4).' ' . substr($this->card, -4);
    }

    public function checkTransaction()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pgapi.biz/v1/p2p_transactions/'.$this->external_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $dec=json_decode($response,true);

        if($dec&&$dec['payload']['state']=='successed'||$dec['payload']['state']=='accepted_successed')
        {
            $this->status=$dec['payload']['state'];
            $this->save();

            $sum_rub=$this->sum;
            $user=User::findOne($this->user_id);
            $user->balance+=$sum_rub;
            $user->save();

            $report=new Reports();
            $report->from=$user->id;
            $report->to=$user->id;
            $report->type='add';
            $report->sum_rub=$sum_rub;
            $report->date=date('Y-m-d H:i:s');
            $report->status='new';
            $report->external_id=$this->id;
            $report->save();

            $req=Request::find()->where(['type'=>'add','external_id'=>$this->id])->one();
            if($req)
            {
                $req->status='success';
                $req->save();
            }

            $message='Поступление '.$this->sum_with_com.' руб';
            $message.="\r\nПользователь ".$user->getConcatened4();
            file_get_contents('https://api.telegram.org/bot'.Config::$bot_api_key.'/sendMessage?text='.urlencode($message).'&chat_id=-1001502172066');

        }


    }

    public function confirmPayment()
    {
        $data=[
            'user_id'=>self::USER_ID
        ];

        $enc_data=json_encode($data,JSON_UNESCAPED_SLASHES);
        $signature=sha1(self::API_SECRET.$enc_data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pgapi.biz/v1/p2p_transactions/'.$this->external_id.'/paid',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS =>'{
    "user_id": '.self::USER_ID.'
}',
            CURLOPT_HTTPHEADER => array(
                'Signature: '.$signature,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //var_dump($response);
    }


    public function getUserData()
    {
        $u=User::findOne($this->user_id);
        if($u)
        return $u->getConcatened4();
    }

    public function getDispute()
    {
        if($this->status=='failed')
        return '<a href="/administrator/rouble_transactions/dispute?id='.$this->id.'">Dispute</a>';
    }

    public function dispute()
    {

        $data=[
            'transaction_id'=>$this->external_id,
            'p2p_dispute[amount]'=>$this->dispute_sum,
            'p2p_dispute[proof_image]'=> new \CURLFile(Yii::$app->basePath.'/web'.$this->dispute_img)
        ];
  //      $data['p2p_dispute']['amount']=$this->dispute_sum;
  //      $data['p2p_dispute']['proof_image']=new \CURLFile(Yii::$app->basePath.$this->dispute_img);
var_dump($data);
        $enc_data=json_encode($data,JSON_UNESCAPED_SLASHES);
       // $signature=sha1(self::API_SECRET.$enc_data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pgapi.biz/v1/p2p_disputes/from_client',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
             //   'Signature: '.$signature,
                'Content-Type: multipart/form-data'
            ),
        ));
        $response = curl_exec($curl);
        if ($errno = curl_errno($curl)) {
            $message = curl_error($errno);
            echo "cURL error ({$errno}):\n {$message}"; // Выведет: cURL error (35): SSL connect error
        }
        curl_close($curl);
        $this->dispute_result=$response;
        $this->save();


//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://pgapi.biz/v1/p2p_disputes/from_client',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>[
//                'transaction_id' => 'f067e6bd10bbc30b0b7db0657180a6b36918e5ed',
//                'p2p_dispute[amount]' => '1000',
//                'p2p_dispute[proof_image]'=> new \CURLFile('/home/l/libertygam/libertygame.ru/public_html/backend/uploads/dispute/LYqq624WwzwjXii5-W4eKpU2tXwSfrSU.jpg')
//            ],
//
//        ));
//        $response = curl_exec($curl);
//var_dump($response);
//        curl_close($curl);
    }

    public function createCashalotPayment()
    {
        $curl = curl_init();

        $data=[
            "amount"=>$this->sum_with_com,
            "redirectTo"=>\yii\helpers\Url::to(['site/index'],true),
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::$CASHALOT_API_BASE_URL.'/v1/finances/merchant/payrolls',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.Config::$CASHALOT_API_KEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response=json_decode($response,true);

        curl_close($curl);
        $this->external_id=$response['uuid'];
        $this->status=$response['status'];
        $this->link=$response['paymentLink'];
        $this->sum_cashalot=$response['amount'];
        $this->save();
        return $response['paymentLink'];
    }

    public function confirmCashalot()
    {
        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::$CASHALOT_API_BASE_URL.'/v1/finances/merchant/payrolls/'.$this->external_id.'/confirm',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.Config::$CASHALOT_API_KEY,
            ),
        ));

        $response = curl_exec($curl);
        $response=json_decode($response,true);

        curl_close($curl);

    }

    public function saveWebhook()
    {
        $curl = curl_init();

        $data=[
            "url"=>\yii\helpers\Url::to(['site/check_cashalot'],true),
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::$CASHALOT_API_BASE_URL.'/v1/finances/merchant/webhook',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS =>json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.Config::$CASHALOT_API_KEY,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response=json_decode($response,true);

        curl_close($curl);
        //var_dump($data);
        var_dump($response);
        return $response;
    }
}
