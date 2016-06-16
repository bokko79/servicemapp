<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $booking_id
 * @property string $description
 *
 * @property Activities $activity
 * @property Offers $offer
 * @property Agreements $agreement
 * @property FeedbackOnProvider[] $feedbackOnProviders
 * @property FeedbackOnUser[] $feedbackOnUsers
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'booking_id'], 'required'],
            [['activity_id', 'offer_id', 'booking_id'], 'integer'],
            [['description'], 'string']
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
            'booking_id' => Yii::t('app', 'Booking ID'),
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
    public function getBooking()
    {
        return $this->hasOne(Bookings::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnProviders()
    {
        return $this->hasMany(FeedbackOnProvider::className(), ['feedback_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnUsers()
    {
        return $this->hasMany(FeedbackOnUser::className(), ['feedback_id' => 'id']);
    }
}
