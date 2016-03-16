<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $unconfirmed_email
 * @property string $fullname
 * @property integer $is_provider
* @property string $invite_hash
* @property string $registered_by
* @property integer $registered_from 
* @property string $registration_ip 
* @property integer $type
* @property integer $logged_in_at
* @property integer $logged_in_from
* @property string $login_count
* @property string $last_activity
* @property string $phone
* @property string $phone_verification_hash
* @property string $rememberme_token
* @property string $role_code
* @property integer $status
* @property integer $flags
* @property string $recovery_token
* @property integer $recovery_sent_at
* @property string $confirmation_token
* @property integer $confirmation_sent_at
* @property integer $confirmed_at
* @property integer $blocked_at
* @property string $updated_at
* @property string $created_at
 *
 * @property Activities[] $activities
 * @property ActivityComments[] $activityComments
 * @property ActivityTracking[] $activityTrackings
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
 * @property Profile $profile
 * @property Provider $provider
 * @property ProviderComments[] $providerComments
 * @property ProviderRecommendation[] $providerRecommendations
 * @property ServiceComments[] $serviceComments
 * @property SocialAccount[] $socialAccounts 
 * @property Token[] $tokens 
 * @property Transactions[] $transactions
 * @property UserDetails $userDetails
 * @property UserFilters $userFilters
 * @property UserImages[] $userImages
 * @property UserLocations[] $userLocations
 * @property UserLog[] $userLogs
 * @property UserNotifications $userNotifications
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
            /*[['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['email_reset_time', 'activation_time', 'last_login_time', 'phone_verification_time'], 'safe'],
            [['is_provider', 'registered_by', 'type', 'login_count', 'online_status', 'last_activity', 'status'], 'integer'],
            [['rememberme_token'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'email_reset_hash', 'fullname', 'activation_hash', 'invite_hash', 'login_hash'], 'string', 'max' => 32],
            [['ip_address'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 24],
            [['phone_verification_hash'], 'string', 'max' => 4],
            [['role_code'], 'string', 'max' => 13],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['created_at', 'updated_at'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],*/
            [['username', 'auth_key', 'password_hash', 'email', 'updated_at', 'created_at'], 'required'],
            [['is_provider', 'registered_by', 'registered_from', 'type', 'logged_in_at', 'logged_in_from', 'login_count', 'last_activity', 'status', 'flags', 'recovery_sent_at', 'confirmation_sent_at', 'confirmed_at', 'blocked_at'], 'integer'],
            [['phone_verification_time', 'updated_at', 'created_at'], 'safe'],
            [['rememberme_token'], 'string'],
            [['username', 'password_reset_token', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['auth_key', 'fullname', 'invite_hash', 'recovery_token', 'confirmation_token'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 60],
            [['registration_ip'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 24],
            [['phone_verification_hash'], 'string', 'max' => 4],
            [['role_code'], 'string', 'max' => 13],
            [['email'], 'unique'], 
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'unconfirmed_email' => 'Unconfirmed Email',
            'fullname' => 'Fullname',
            'is_provider' => 'Is Provider',
            'invite_hash' => 'Invite Hash',
            'registered_by' => 'Registered By',
            'registered_from' => 'Registered From',
            'registration_ip' => 'Registration Ip',
            'type' => 'Type',
            'logged_in_at' => 'Logged In At',
            'logged_in_from' => 'Logged In From',
            'login_count' => 'Login Count',
            'last_activity' => 'Last Activity',
            'phone' => 'Phone',
            'phone_verification_hash' => 'Phone Verification Hash',
            'phone_verification_time' => 'Phone Verification Time',
            'rememberme_token' => 'Rememberme Token',
            'role_code' => 'Role Code',
            'status' => 'Status',
            'flags' => 'Flags',
            'recovery_token' => 'Recovery Token',
            'recovery_sent_at' => 'Recovery Sent At',
            'confirmation_token' => 'Confirmation Token',
            'confirmation_sent_at' => 'Confirmation Sent At',
            'confirmed_at' => 'Confirmed At',
            'blocked_at' => 'Blocked At',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
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
    public function getProfile() 
    { 
       return $this->hasOne(Profile::className(), ['user_id' => 'id']); 
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
    public function getSocialAccounts() 
    { 
       return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']); 
    } 

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getTokens() 
    { 
       return $this->hasMany(Token::className(), ['user_id' => 'id']); 
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
    public function getDetails()
    {
        return $this->hasOne(UserDetails::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilters()
    {
        return $this->hasOne(UserFilters::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
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
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsConfirmed()
    {
        return $this->confirmed_at != null;
    }

    /**
     * @return bool Whether the user is blocked or not.
     */
    public function getIsBlocked()
    {
        return $this->blocked_at != null;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsVerifiedPayment()
    {
        return $this->userPayments != null;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsVerifiedPhone()
    {
        return $this->phone_verification_hash == null;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getIsCompletedSetup()
    {
        return $this->setupMeter() > 90;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getHasCredit()
    {
        return $this->details->Mcoin > 0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->details->loc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return $this->details->image;
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
    public function getCurrency()
    {
        return $this->details->currency;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function setupMeter()
    {
        return 95;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function getName()
    {
        return $this->fullname ? $this->fullname : '@'.$this->username;
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function avatar()
    {
        return Html::img('@web/images/users/thumbs/'.$this->avatar->ime);
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function verificationPack()
    { ?>

        <div class="fs_11 label label-<?= $this->isConfirmed ? 'success' : 'warning' ?>"><i class="fa fa-user"></i></div>
        <div class="fs_11 label label-<?= $this->isVerifiedPayment ? 'success' : 'warning' ?>"><i class="fa fa-euro"></i></div>
        <div class="fs_11 label label-<?= $this->isVerifiedPhone ? 'success' : 'warning' ?>"><i class="fa fa-phone"></i></div>
        <div class="fs_11 label label-<?= $this->isCompletedSetup ? 'success' : 'warning' ?>"><i class="fa fa-check"></i></div>
        <div class="fs_11 label label-<?= $this->isBlocked ? 'success' : 'warning' ?>"><i class="fa fa-ban"></i></div>
        <div class="fs_11 label label-<?= $this->hasCredit ? 'success' : 'warning' ?>"><i class="fa fa-credit-card"></i></div>

        <?php
    }

    /**
     * @return bool Whether the user is confirmed or not.
     */
    public function quickVerificationPack()
    { ?>

        <div class="margin-right-5 float-left"><i class="fa fa-euro" style="color:<?= $this->isVerifiedPayment ? 'green' : 'orange' ?>"></i></div>
        <div class="margin-right-5 float-left"><i class="fa fa-phone" style="color:<?= $this->isVerifiedPhone ? 'green' : 'orange' ?>"></i></div>
        <div class="margin-right-5 float-left"><i class="fa fa-check" style="color:<?= $this->isCompletedSetup ? 'green' : 'orange' ?>"></i></div>
        <div class="margin-right-5 float-left"><i class="fa fa-ban" style="color:<?= $this->isBlocked ? 'green' : 'orange' ?>"></i></div>
        
        <?php
    }

    public function starRating($avg_rate)
    {
        $full = '<i class="fa fa-star" style=""></i>';
        $half = '<i class="fa fa-star-half-o" style=""></i>';
        $empty = '<i class="fa fa-star-o" style=""></i>';

        if ($avg_rate<0.5) { // no
            $star = $empty.$empty.$empty.$empty.$empty;
        } else if (0.5<=$avg_rate && $avg_rate<1) { // 0,5 star
            $star = $half.$empty.$empty.$empty.$empty;
        } else if (1<=$avg_rate && $avg_rate<1.5) { // 1 star
            $star = $full.$empty.$empty.$empty.$empty;
        } else if (1.5<=$avg_rate && $avg_rate<2) { // 1,5 star
            $star = $full.$half.$empty.$empty.$empty;
        } else if (2<=$avg_rate && $avg_rate<2.5) { // 2 stars
            $star = $full.$full.$empty.$empty.$empty;
        } else if (2.5<=$avg_rate && $avg_rate<3) { // 2,5 star
            $star = $full.$full.$half.$empty.$empty;
        } else if (3<=$avg_rate && $avg_rate<3.5) { // 3 stars
            $star = $full.$full.$full.$empty.$empty;
        } else if ($avg_rate>=3.5 && $avg_rate<4) { // 3,5 star
            $star = $full.$full.$full.$half.$empty;
        } else if (4<=$avg_rate && $avg_rate<4.3) { // 4 stars
            $star = $full.$full.$full.$full.$empty;
        } else if (4.3<=$avg_rate && $avg_rate<4.7) { // 4,5 star
            $star = $full.$full.$full.$full.$half;
        } else { // 5 stars
            $star = $full.$full.$full.$full.$full;
        }

        return $star;
    }
}
