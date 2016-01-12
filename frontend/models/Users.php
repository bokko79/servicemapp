<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $password_token
 * @property string $password_reset_time
 * @property string $user_email
 * @property string $email_reset_hash
 * @property string $email_reset_time
 * @property string $fullname
 * @property integer $is_provider
 * @property string $ip_address
 * @property string $registration_time
 * @property string $activation_hash
 * @property string $activation_time
 * @property string $invite_hash
 * @property string $registered_by
 * @property integer $type
 * @property integer $status
 * @property string $status_update_time
 * @property string $last_login_time
 * @property string $login_count
 * @property string $login_hash
 * @property integer $online_status
 * @property integer $last_activity
 * @property string $phone
 * @property string $phone_verification_hash
 * @property string $phone_verification_time
 * @property string $rememberme_token
 * @property string $role_code
 * @property integer $failed_logins
 * @property string $last_failed_login
 * @property string $facebook_uid
 * @property string $google_uid
 * @property string $twitter_uid
 * @property string $linkedin_uid
 *
 * @property Users $registeredBy
 * @property Users[] $users
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_token', 'user_email'], 'required'],
            [['password_reset_time', 'email_reset_time', 'registration_time', 'activation_time', 'status_update_time', 'last_login_time', 'phone_verification_time'], 'safe'],
            [['is_provider', 'registered_by', 'type', 'status', 'login_count', 'online_status', 'last_activity', 'failed_logins'], 'integer'],
            [['rememberme_token', 'last_failed_login', 'facebook_uid', 'google_uid', 'twitter_uid', 'linkedin_uid'], 'string'],
            [['username'], 'string', 'max' => 16],
            [['password', 'password_hash', 'email_reset_hash', 'fullname', 'activation_hash', 'invite_hash', 'login_hash'], 'string', 'max' => 32],
            [['password_token', 'role_code'], 'string', 'max' => 13],
            [['user_email'], 'string', 'max' => 64],
            [['ip_address'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 24],
            [['phone_verification_hash'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_token' => Yii::t('app', 'Password Token'),
            'password_reset_time' => Yii::t('app', 'Password Reset Time'),
            'user_email' => Yii::t('app', 'User Email'),
            'email_reset_hash' => Yii::t('app', 'Email Reset Hash'),
            'email_reset_time' => Yii::t('app', 'Email Reset Time'),
            'fullname' => Yii::t('app', 'Fullname'),
            'is_provider' => Yii::t('app', 'Is Provider'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'registration_time' => Yii::t('app', 'Registration Time'),
            'activation_hash' => Yii::t('app', 'Activation Hash'),
            'activation_time' => Yii::t('app', 'Activation Time'),
            'invite_hash' => Yii::t('app', 'Invite Hash'),
            'registered_by' => Yii::t('app', 'Registered By'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'status_update_time' => Yii::t('app', 'Status Update Time'),
            'last_login_time' => Yii::t('app', 'Last Login Time'),
            'login_count' => Yii::t('app', 'Login Count'),
            'login_hash' => Yii::t('app', 'Login Hash'),
            'online_status' => Yii::t('app', 'Online Status'),
            'last_activity' => Yii::t('app', 'Last Activity'),
            'phone' => Yii::t('app', 'Phone'),
            'phone_verification_hash' => Yii::t('app', 'Phone Verification Hash'),
            'phone_verification_time' => Yii::t('app', 'Phone Verification Time'),
            'rememberme_token' => Yii::t('app', 'Rememberme Token'),
            'role_code' => Yii::t('app', 'Role Code'),
            'failed_logins' => Yii::t('app', 'Failed Logins'),
            'last_failed_login' => Yii::t('app', 'Last Failed Login'),
            'facebook_uid' => Yii::t('app', 'Facebook Uid'),
            'google_uid' => Yii::t('app', 'Google Uid'),
            'twitter_uid' => Yii::t('app', 'Twitter Uid'),
            'linkedin_uid' => Yii::t('app', 'Linkedin Uid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'registered_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['registered_by' => 'id']);
    }
}
