<?php
namespace common\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
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
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
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
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
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
     * @return boolean if password provided is valid for current user
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
     * Generates new password hash
     */
    public function generatePasswordHash()
    {
        $this->password_hash = Yii::$app->security->generateRandomString() . '_' . time();
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
    /**
     * Generates "remember me" authentication key
     */
    public function generateEmailResetHash()
    {
        $this->email_reset_hash = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates
     */
    public function generateActivationHash()
    {
        $this->activation_hash = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates
     */
    public function generateInviteHash()
    {
        $this->invite_hash = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates
     */
    public function generateLoginHash()
    {
        $this->login_hash = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates
     */
    public function generatePhoneVerificationHash()
    {
        $this->phone_verification_hash = substr(str_shuffle(str_repeat("0123456789", 4)), 0, 4);
    }
    /**
     * Generates
     */
    public function generateRoleCode()
    {
        $this->role_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 13)), 0, 13);
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsOwner()
    {
        return $this->role->name == 'owner';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsAdmin()
    {
        return $this->role->name == 'admin';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsEditor()
    {
        return $this->role->name == 'editor';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsFree()
    {
        return $this->role->name == 'free' or $this->role->name == 'free_pro';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsSilver()
    {
        return $this->role->name == 'silver' or $this->role->name == 'silver_pro';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsGold()
    {
        return $this->role->name == 'gold' or $this->role->name == 'gold_pro';
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsPremium()
    {
        return $this->role->name == 'premium' or $this->role->name == 'premium_pro';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->details->role;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasOne(UserDetails::className(), ['user_id' => 'id']);
    }
}