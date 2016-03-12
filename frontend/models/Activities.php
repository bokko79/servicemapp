<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "activities".
 *
 * @property string $id
 * @property string $activity
 * @property string $user_id
 * @property string $type
 * @property string $status
 * @property string $time
 * @property string $description
 *
 * @property User $user
 * @property ActivityComments[] $activityComments
 * @property ActivityTracking[] $activityTrackings
 * @property Agreements[] $agreements
 * @property Bids[] $bids
 * @property Feedback[] $feedbacks
 * @property Log[] $logs
 * @property Offers[] $offers
 * @property OrderServices[] $orderServices
 * @property Presentations[] $presentations
 * @property Promotions[] $promotions
 */
class Activities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity', 'user_id', 'time'], 'required'],
            [['activity', 'type', 'status', 'description'], 'string'],
            [['user_id'], 'integer'],
            [['activity'], 'default', 'value'=>'order'],
            [['user_id'], 'default', 'value'=>Yii::$app->user->id],
            [['type'], 'default', 'value'=>'normal'],
            [['status'], 'default', 'value'=>'active'],
            [['time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
            //[['time'], 'default', 'value'=>date('Y-m-d H:i:s')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity' => Yii::t('app', 'Activity'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(ActivityComments::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityTrackings()
    {
        return $this->hasMany(ActivityTracking::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgreements()
    {
        return $this->hasMany(Agreements::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offers::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['activity_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        return $this->hasMany(Promotions::className(), ['activity_id' => 'id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function FeedText()
    {
        switch ($this->activity) {
            case 'order':
                return Yii::t('app', 'poručuje uslugu');
                break;

            case 'promotion':
                return Yii::t('app', 'promoviše uslugu');
                break;

            case 'bid':
                return Yii::t('app', 'daje ponudu na poručene usluge');
                break;

            case 'agreement':
                return Yii::t('app', 'je izabrao pružaoca usluge');
                break;

            case 'feedback':
                return Yii::t('app', 'je ocenio pružaoca usluge');
                break;

            case 'comment_order':
                return Yii::t('app', 'komentariše na porudžbinu usluge');
                break;
            
            default:
                return Yii::t('app', 'promoviše uslugu');
                break;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function loadActivity($user, $action='order', $type='normal', $status='active')
    {
        $activity = new Activities();
        $activity->activity = $action;
        $activity->user_id = $user;
        $activity->type = $type;
        $activity->status = $status;
        $activity->time = date('Y-m-d H:i:s');

        if($activity){
            return $activity;
        } else {
            return false; 
        }
    }
}
