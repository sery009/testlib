<?php
namespace common\models;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use IEXBase\TronAPI\Tron;
//use kornrunner\Keccak;
//use BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory;
//use BitWasp\Bitcoin\Crypto\Random\Random;
//use BitWasp\Buffertools\Buffer;
//use BitWasp\Bitcoin\Base58;

/**
 * User model
 *
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $phone
 * @property string $phone_r
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 * @property string $referal_id
 * @property string $confirm
 * @property string $name
 * @property string $status
 * @property string $balance
 * @property string $second_name
 * @property string $last_name
 * @property string $avatar
 * @property string $wallet
 * @property string $register_date
 * @property string $telegram
 * @property string $nick
 * @property string $blogger
 * @property string $register_count
 * @property string $promocode
 * @property string $inst
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_WAIT = 5;
    const STATUS_PROMO = 1;
public $cnt;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['name','email','phone','phone_r','referal_id','role','balance'], 'safe'],
            [['second_name','last_name','avatar','wallet'], 'safe'],
            [['pass','pass2','pass3'], 'safe'],
            [['register_date'], 'safe'],
            [['telegram'], 'safe'],
            [['nick'], 'safe'],
            [['p'], 'safe'],
            [['inst'], 'safe'],
            [['promocode'], 'safe'],
            [['register_count'], 'safe'],
        ];
    }

    public $p;
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public static function isUserAdmin($user)
    {
        if ($user->role=='admin')
        {
            return true;
        } else {
            return false;
        }
    }





    public function getAvatar_src()
    {
        if($this->avatar)
            return $this->avatar;
        else
            return '/lc/img/uu.png';
    }

    public function getConcatened()
    {
        return $this->name.' '.$this->second_name;
    }

    public function getConcatened2()
    {
        return $this->name.' '.$this->second_name.' '.$this->email.' id '.$this->id;
    }

    public function getConcatened3()
    {
        return $this->nick.' '.$this->email;
    }

    public function getConcatened4()
    {
        return $this->nick.' '.$this->email.' id '.$this->id;
    }

    public $pass;
    public $pass2;
    public $pass3;


    public function getAddress()
    {
        $addr=BtcAddress::find()->where(['user_id'=>$this->id])->one();
        if($addr)
            return $addr->address;
        else
        {
            $wallet="";
            $count = BtcAddress::find()->where(1)->count();
            //echo $count;
            $row = 1;
            $handle = fopen($_SERVER['DOCUMENT_ROOT']."/address/mlm5.csv", "r");
            //var_dump($handle);
            if ($handle !== FALSE) {
                $i=0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    //echo $data[1];
                    if($row>$count)
                    {
                        $address=new BtcAddress();
                        $address->user_id=Yii::$app->user->id;
                        // $address->public=$addressKeyChain->public;
                        //$address->private=$addressKeyChain->private;
                        $address->address=$data[1];
                        $wallet=$data[1];
                        //$address->wif=$addressKeyChain->wif;
                        $address->save();
                        break;
                    }
                    $row++;
                }
                fclose($handle);
            }
            return $wallet;
        }
    }


    public function recover()
    {
        /*$password=Config::generatePassword(8);
        $this->setPassword($password);
        $this->save();*/
        $confirm=Yii::$app->security->generateRandomString();
        $this->confirm=$confirm;
        $this->save();
        $link=Url::to(['site/recover2','confirm'=>$confirm],true);
        Config::sendMessage('recover',['link'=>$link],$this->email,'Восстановление пароля');
    }

    public function getReferal_link()
    {
        return Url::to(['site/r','id'=>$this->id],true);
    }

    public function getReferalUser()
    {
        return User::findOne($this->referal_id)->concatened2;
    }

    public function getReferalUserModel()
    {
        return User::findOne($this->referal_id);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p' => 'Пароль',
            'name' => 'Имя',
            'second_name' => 'Фамилия',
            'referalUser' => 'Пригласитель',
            'register_date' => 'Дата регистрации',
            'date' => 'Date',
            'balance' => 'Баланс',
            'wallet' => 'Кошелек',

        ];
    }




    public function getChildUsers()
    {
        return self::find()->where(['referal_id'=>$this->id,'status'=>self::STATUS_ACTIVE])->all();
    }



    public function getAllUserIds()
    {
        $ids=[];

        $ids2=[$this->id];
        while (true)
        {
            $users=self::find()->where(['status'=>self::STATUS_ACTIVE])->andWhere(['in','referal_id',$ids2])->all();
            $ids2=[];
            if($users)
            {
                foreach ($users as $user)
                {
                    if($user->id!=$user->referal_id)
                    {
                        $ids[]=$user->id;
                        $ids2[]=$user->id;
                    }

                }
            }
            if(!$ids2)
                break;
        }
        return $ids;
    }


    public function isLevelOpen($level)
    {
        if(Matrix::find()->where(['user_id'=>$this->id,'level'=>$level])->count()>0)
            return true;
        return false;
    }

    public function findPlace($level)
    {
        if(Matrix::find()->where(['user_id'=>$this->id,'level'=>$level])->one())
            return;

        if(!Matrix::find()->where(['level'=>$level])->count())
        {
            $m=new Matrix();
            $m->user_id=$this->id;
            $m->parent_id=0;
            $m->parent_user_id=0;
            $m->level=$level;
            $m->position='';
            $m->line=0;
            $m->date=date('Y-m-d H:i:s');
            $m->save();
            return;
        }
        $referal_user=$this->getReferalUserModel();
        if(!$referal_user)
            $referal_user=User::findOne(1);
        $matrix=Matrix::find()->where(['user_id'=>$referal_user->id,'level'=>$level])->one();//ищем пригласителя в матрице
        if(!$matrix)
            $matrix=Matrix::find()->where(['line'=>0,'level'=>$level])->one();//если пригласителя нет, то выбираем самого первого


        $all_matrixes=[$matrix];

        $c=0;
        while (true)
        {
            $c++;
            $current_loop_matrix=array_shift($all_matrixes);
            $res=$this->hasPlaceInCurrentMatrix($current_loop_matrix);
            if($res['result']==true)
            {
                $this->saveMatrixPosition($current_loop_matrix,$referal_user,$res['position']);
                return true;
            }
            else
            {
                $ms=$res['matrixes'];

                foreach ($ms as $m)
                {
                    array_push($all_matrixes,$m);
                }
            }
            if($c>39 && $matrix->line>0)//первые 3 личных уровня закончились
            {
                $c=-10000;
                $all_matrixes=[$matrix];
            }
        }

    }

    public function saveMatrixPosition($matrix,$referal_user,$position)
    {
        $m=new Matrix();
        $m->user_id=$this->id;
        $m->parent_id=$matrix->id;
        $m->parent_user_id=$referal_user->id;
        $m->level=$matrix->level;
        $m->position=$position;
        $m->line=$matrix->line+1;
        $m->date=date('Y-m-d H:i:s');
        $m->save();
    }

    public function hasPlaceInCurrentMatrix($matrix)
    {

        $matrixes=Matrix::find()->where(['parent_id'=>$matrix->id,'level'=>$matrix->level])->orderBy(['position'=>SORT_ASC])->all();
        if(count($matrixes)==3)//матрица занята
        {
            return ['result'=>false,'matrixes'=>$matrixes];
        }
        elseif(!$matrixes)//матрица пустая
        {
            return ['result'=>true,'position'=>Matrix::$POSITION_LEFT];
        }
        else//в матрице есть место
        {
            $cnt=count($matrixes);//количество элементов 1 или 2 может быть
            if($cnt==1)
            {
                if($matrixes[0]->position!=Matrix::$POSITION_LEFT)
                    return ['result'=>true,'position'=>Matrix::$POSITION_LEFT];
                else
                    return ['result'=>true,'position'=>Matrix::$POSITION_CENTER];
            }
            elseif($cnt==2)
            {
                if($matrixes[0]->position!=Matrix::$POSITION_LEFT&&$matrixes[1]->position!=Matrix::$POSITION_LEFT)
                    return ['result'=>true,'position'=>Matrix::$POSITION_LEFT];
                elseif($matrixes[0]->position!=Matrix::$POSITION_CENTER&&$matrixes[1]->position!=Matrix::$POSITION_CENTER)
                    return ['result'=>true,'position'=>Matrix::$POSITION_CENTER];
                else
                    return ['result'=>true,'position'=>Matrix::$POSITION_RIGHT];
            }

        }

    }

    public function canTakeFromLevel($level,$line)
    {

        $m=Matrix::find()->where(['user_id'=>$this->id,'level'=>$level])->one();
        $my_users_cnt=Matrix::find()->where(['level'=>$level,'parent_user_id'=>$this->id])->count();

        if($line==1)
        {
            if($my_users_cnt>=1)
                return true;
            /*elseif($m&&$m->countUsersInLine(2)==pow(3,2))
                return true;*/
        }
        elseif($line==2)
        {
            if($my_users_cnt>=2)
                return true;
            /*elseif($m&&$m->countUsersInLine(3)==pow(3,3))
                return true;*/
        }
        elseif($line==3)
        {
            if($my_users_cnt>=3)
                return true;
            /*elseif($m&&$m->countUsersInLine(4)==pow(3,4))
                return true;*/
        }
        elseif($line==4)
        {
            if($my_users_cnt>=6)
                return true;
        }
        elseif($line==5)
        {
            if($my_users_cnt>=24)
                return true;
        }
        elseif($line==6)
        {
            if($my_users_cnt>=72)
                return true;
        }
        return false;
    }


    public function getUsdtWallet()
    {
        $wallet=UsdtWallets::find()->where(['user_id'=>$this->id])->one();

        if($wallet)
        {
            $wallet->date=date('Y-m-d H:i:s');
            $wallet->save();
            return $wallet->wallet;
        }
        else
        {
            $tron = new \IEXBase\TronAPI\Tron();

            $generateAddress = $tron->generateAddress(); // or createAddress()
            $isValid = $tron->isAddress($generateAddress->getAddress());
            if(!$isValid)
                $generateAddress = $tron->generateAddress();
            $addr=new UsdtWallets();
            $addr->user_id=$this->id;
            $addr->wallet=$generateAddress->getAddress(true);
            $addr->private_key=$generateAddress->getPrivateKey();
            $addr->public_key=$generateAddress->getPublicKey();
            $addr->date=date('Y-m-d H:i:s');
            $addr->save();
            return $addr->wallet;
        }
    }

    public function addComToUsers($id)
    {
        $matrix=Matrix::find()->where(['level'=>$id,'user_id'=>$this->id])->one();
        if($matrix->parent_id)//если не самый верхний
        {
            $cur_matrix=$matrix;
            for($line=1;$line<=6;$line++)
            {
                $parent_matrix=Matrix::findOne($cur_matrix->parent_id);
                if($parent_matrix)
                {
                    $user=User::findOne($parent_matrix->user_id);
                    if($user->canTakeFromLevel($id,$line))
                    {
                        $price=\common\models\Config::$percents[$line]*Config::$LEVELS[$id];
                        $report=new Reports();
                        $report->from=$this->id;
                        $report->to=$user->id;
                        $report->type='bonus';
                        $report->sum_rub=$price;
                        $report->date=date('Y-m-d H:i:s');
                        $report->status='success';
                        $report->external_id=0;
                        $report->level=$id;
                        $report->line=$line;
                        $report->save();

                        $user->balance+=$price;
                        $user->save();
                        $user->checkHold($id,$line);

                    }
                    else
                    {
                        $price=\common\models\Config::$percents[$line]*Config::$LEVELS[$id];
                        $report=new Reports();
                        $report->from=$this->id;
                        $report->to=$user->id;
                        $report->type='bonus';
                        $report->sum_rub=$price;
                        $report->date=date('Y-m-d H:i:s');
                        $report->status='success';
                        $report->external_id=0;
                        $report->level=$id;
                        $report->line=$line;
                        $report->hold=1;
                        $report->save();
                        if($line>1&&$line<4)
                            $user->checkHold($id,$line-1);
                    }
                }

                $cur_matrix=$parent_matrix;
            }
        }
    }

    public function checkHold($level,$line)
    {
        $reports=Reports::find()->where(['hold'=>1,'to'=>$this->id,'line'=>$line,'level'=>$level])->all();
        if($reports)
        {
            if($this->canTakeFromLevel($level,$line))
            {
                foreach ($reports as $report)
                {
                    $report->hold=0;
                    $report->save();
                    $this->balance+=$report->sum_rub;
                }
                $this->save();
                return true;
            }
        }
        else{
            if($this->canTakeFromLevel($level,$line))
                return true;
        }
        return false;
    }
    public function unlockMe($level)
    {
        $m=Matrix::find()->where(['user_id'=>$this->id,'level'=>$level])->one();
        if($m)
        {
            $a=$this->checkHold($level,1);
            if($a)
                $a=$this->checkHold($level,2);
            if($a)
                $a=$this->checkHold($level,3);
            if($a)
                $a=$this->checkHold($level,4);
            if($a)
                $a=$this->checkHold($level,5);
            if($a)
                $a=$this->checkHold($level,6);

        }
    }

    public function unlockReferal($level)
    {
        $referal=User::findOne($this->referal_id);
        if($referal)
        {
            $m=Matrix::find()->where(['user_id'=>$referal->id,'level'=>$level])->one();
            if($m)
            {
                $a=$referal->checkHold($level,1);
                if($a)
                    $a=$referal->checkHold($level,2);
                if($a)
                    $a=$referal->checkHold($level,3);
                if($a)
                    $a=$referal->checkHold($level,4);
                if($a)
                    $a=$referal->checkHold($level,5);
                if($a)
                    $a=$referal->checkHold($level,6);

            }
        }
    }

    public function getHold($level,$line)
    {
        return intval(\common\models\Reports::find()->where(['to'=>$this->id,'level'=>$level,'line'=>$line,'hold'=>1])->sum('sum_rub'));
    }


    public function has3LinesFull($level=1)
    {
        return false;
        $matrix=Matrix::find()->where(['user_id'=>$this->id,'level'=>$level])->one();
        if($matrix)
        {
            $matrixes_line_1=Matrix::find()->where(['parent_id'=>$matrix->id,'level'=>$level])->all();
            if(count($matrixes_line_1)==3)
            {
                $matrixes_line_2=[];
                foreach ($matrixes_line_1 as $matrix_line_1)
                {
                    $matrixes_line_2[]=Matrix::find()->where(['parent_id'=>$matrixes_line_1->id,'level'=>$level])->all();
                }
                if(count($matrixes_line_2)==9)
                {
                    $matrixes_line_3=[];
                    foreach ($matrixes_line_2 as $matrix_line_2)
                    {
                        $matrixes_line_3[]=Matrix::find()->where(['parent_id'=>$matrixes_line_2->id,'level'=>$level])->all();
                    }
                    if(count($matrixes_line_3)>=27)
                        return true;
                }
            }
        }
        return false;
    }
}
