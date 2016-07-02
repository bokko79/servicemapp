<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback_on_user".
 *
 * @property string $id
 * @property string $feedback_id
 * @property string $booking_id
 * @property string $provider_id
 * @property string $user_id
 * @property string $professionalism
 * @property string $responsibility
 * @property string $concise
 * @property string $payment
 * @property string $nagging
 * @property string $time
 *
 * @property Provider $provider
 * @property User $user
 * @property Feedback $feedback
 * @property Agreements $agreement
 */
class FeedbackOnUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback_on_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'booking_id', 'provider_id', 'user_id', 'time'], 'required'],
            [['feedback_id', 'booking_id', 'provider_id', 'user_id'], 'integer'],
            [['professionalism', 'responsibility', 'concise', 'payment', 'nagging'], 'string'],
            [['time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'feedback_id' => Yii::t('app', 'Feedback ID'),
            'booking_id' => Yii::t('app', 'Booking ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'professionalism' => Yii::t('app', 'Professionalism'),
            'responsibility' => Yii::t('app', 'Responsibility'),
            'concise' => Yii::t('app', 'Concise'),
            'payment' => Yii::t('app', 'Payment'),
            'nagging' => Yii::t('app', 'Nagging'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
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
    public function getFeedback()
    {
        return $this->hasOne(Feedback::className(), ['id' => 'feedback_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Bookings::className(), ['id' => 'booking_id']);
    }
}
