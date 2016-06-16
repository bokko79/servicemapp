<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $type
 * @property string $validity
 * @property string $transaction_id
 * @property integer $voucher_issued
 * @property string $time
 * @property string $description
 *
 * @property Activities $activity
 * @property Offers $offer
 * @property Feedback[] $feedbacks
 * @property FeedbackOnProvider[] $feedbackOnProviders
 * @property FeedbackOnUser[] $feedbackOnUsers
 * @property Transactions[] $transactions
 */
class Bookings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'time'], 'required'],
            [['activity_id', 'offer_id', 'transaction_id', 'voucher_issued'], 'integer'],
            [['type', 'description'], 'string'],
            [['validity', 'time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'offer_id' => Yii::t('app', 'Offer ID'),
            'type' => Yii::t('app', 'Type'),
            'validity' => Yii::t('app', 'Validity'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'voucher_issued' => Yii::t('app', 'Voucher Issued'),
            'time' => Yii::t('app', 'Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offers::className(), ['id' => 'offer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnProviders()
    {
        return $this->hasMany(FeedbackOnProvider::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnUsers()
    {
        return $this->hasMany(FeedbackOnUser::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['booking_id' => 'id']);
    }
}
