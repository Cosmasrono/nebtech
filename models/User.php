<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\PasswordResetRequestForm;

class User extends ActiveRecord implements IdentityInterface
{
    public $password;

    const SCENARIO_SIGNUP = 'signup';

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const STATUS_UNVERIFIED = 5;

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['password_hash']);
    }

    public function rules()
    {
        return [
            [['company_email', 'company_name', 'password'], 'required', 'on' => self::SCENARIO_SIGNUP, 'message' => '{attribute} cannot be blank.'],
            ['company_email', 'email', 'message' => 'Please enter a valid email address.'],
            ['company_email', 'unique', 'message' => 'This email is already in use.'],
            ['company_name', 'required'],
            ['company_name', 'string'],
            ['company_name', 'unique', 'message' => 'This company name is already taken.'],
            ['company_name', 'string', 'max' => 255],

            ['password', 'string', 'min' => 6, 'message' => 'Password should be at least 6 characters long.'],
            
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['signup'] = ['company_email','company_name' ,'password'];
        return $scenarios;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord && !empty($this->password)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                $this->status = self::STATUS_UNVERIFIED; // Set status to unverified for new users
                $this->generateEmailVerificationToken(); // Generate verification token
            }
            return true;
        }
        return false;
    }

    public function getUsername()
    {
        return $this->company_email;
    }

    public function isActive()
                {
        return $this->status === self::STATUS_ACTIVE;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByEmail($email)
    {
        return static::findOne(['company_email' => $email, 'status' => self::STATUS_ACTIVE]);
    }
 

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        if (empty($this->password_hash)) {
            Yii::error("Password hash is empty for user: " . $this->company_email);
            return false;
        }
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        return $this->save(false);
    }

    public function generateVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    public static function findByVerificationToken($token)
    {
        return static::findOne(['verification_token' => $token, 'status' => self::STATUS_INACTIVE]);
    }

    public function removeVerificationToken()
    {
        $this->verification_token = null;
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
    
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'] ?? 3600; // Default to 1 hour if not set
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getCompanyName()
    {
        return $this->company_name;
    }
}
