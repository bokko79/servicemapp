<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_reset_hash
 * @property string $email_reset_time
 * @property string $fullname
 * @property integer $is_provider
 * @property string $ip_address
 * @property string $activation_hash
 * @property string $activation_time
 * @property string $invite_hash
 * @property string $registered_by
 * @property integer $type
 * @property string $last_login_time
 * @property string $login_count
 * @property string $login_hash
 * @property integer $online_status
 * @property string $last_activity
 * @property string $phone
 * @property string $phone_verification_hash
 * @property string $phone_verification_time
 * @property string $rememberme_token
 * @property string $role_code
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Activities[] $activities
 * @property ActivityComments[] $activityComments
 * @property ActivityTracking[] $activityTrackings
 * @property CsActions[] $csActions
 * @property CsAttributeModels[] $csAttributeModels
 * @property CsIndustries[] $csIndustries
 * @property CsObjects[] $csObjects
 * @property CsServices[] $csServices
 * @property Events[] $events
 * @property FeedbackOnProvider[] $feedbackOnProviders
 * @property FeedbackOnUser[] $feedbackOnUsers
 * @property Locations[] $locations
 * @property Log[] $logs
 * @property Messages[] $messages
 * @property MsgThread[] $msgThreads
 * @property MsgThread[] $msgThreads0
 * @property Notifications[] $notifications
 * @property PostComment[] $postComments
 * @property Provider $provider
 * @property ProviderComments[] $providerComments
 * @property ProviderRecommendation[] $providerRecommendations
 * @property ServiceComments[] $serviceComments
 * @property Transactions[] $transactions
 * @property UserDetails $userDetails
 * @property UserFilters $userFilters
 * @property UserImages[] $userImages
 * @property UserLocations[] $userLocations
 * @property UserLog[] $userLogs
 * @property UserNotifications $userNotifications
 * @property UserNotificationsSms $userNotificationsSms
 * @property UserObjects[] $userObjects
 * @property UserOrder[] $userOrders
 * @property UserPayment[] $userPayments
 * @property UserRecent[] $userRecents
 * @property UserServices[] $userServices
 */
class User extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['email_reset_time', 'activation_time', 'last_login_time', 'phone_verification_time'], 'safe'],
            [['is_provider', 'registered_by', 'type', 'login_count', 'online_status', 'last_activity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['rememberme_token'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'email_reset_hash', 'fullname', 'activation_hash', 'invite_hash', 'login_hash'], 'string', 'max' => 32],
            [['ip_address'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 24],
            [['phone_verification_hash'], 'string', 'max' => 4],
            [['role_code'], 'string', 'max' => 13],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
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
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'email_reset_hash' => Yii::t('app', 'Email Reset Hash'),
            'email_reset_time' => Yii::t('app', 'Email Reset Time'),
            'fullname' => Yii::t('app', 'Fullname'),
            'is_provider' => Yii::t('app', 'Is Provider'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'activation_hash' => Yii::t('app', 'Activation Hash'),
            'activation_time' => Yii::t('app', 'Activation Time'),
            'invite_hash' => Yii::t('app', 'Invite Hash'),
            'registered_by' => Yii::t('app', 'Registered By'),
            'type' => Yii::t('app', 'Type'),
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
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activities::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityComments()
    {
        return $this->hasMany(ActivityComments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityTrackings()
    {
        return $this->hasMany(ActivityTracking::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsActions()
    {
        return $this->hasMany(CsActions::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributeModels()
    {
        return $this->hasMany(CsAttributeModels::className(), ['entry_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustries()
    {
        return $this->hasMany(CsIndustries::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjects()
    {
        return $this->hasMany(CsObjects::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServices()
    {
        return $this->hasMany(CsServices::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnProviders()
    {
        return $this->hasMany(FeedbackOnProvider::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnUsers()
    {
        return $this->hasMany(FeedbackOnUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['sender' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMsgThreads()
    {
        return $this->hasMany(MsgThread::className(), ['sender' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMsgThreads0()
    {
        return $this->hasMany(MsgThread::className(), ['receiver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderComments()
    {
        return $this->hasMany(ProviderComments::className(), ['reviewer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderRecommendations()
    {
        return $this->hasMany(ProviderRecommendation::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceComments()
    {
        return $this->hasMany(ServiceComments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasOne(UserDetails::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFilters()
    {
        return $this->hasOne(UserFilters::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserImages()
    {
        return $this->hasMany(UserImages::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLocations()
    {
        return $this->hasMany(UserLocations::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasOne(UserNotifications::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotificationsSms()
    {
        return $this->hasOne(UserNotificationsSms::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjects()
    {
        return $this->hasMany(UserObjects::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPayments()
    {
        return $this->hasMany(UserPayment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRecents()
    {
        return $this->hasMany(UserRecent::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServices()
    {
        return $this->hasMany(UserServices::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->userDetails->loc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return $this->userDetails->image;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->userDetails->role;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->userDetails->currency;
    }
}
