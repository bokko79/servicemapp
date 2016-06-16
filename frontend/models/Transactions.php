<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property string $id
 * @property string $user_id
 * @property string $booking_id
 * @property string $transaction_type
 * @property string $time
 *
 * @property User $user
 * @property Agreements $agreement
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'booking_id', 'transaction_type', 'time'], 'required'],
            [['user_id', 'booking_id'], 'integer'],
            [['transaction_type'], 'string'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'booking_id' => Yii::t('app', 'Booking ID'),
            'transaction_type' => Yii::t('app', 'Transaction Type'),
            'time' => Yii::t('app', 'Time'),
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
    public function getBooking()
    {
        return $this->hasOne(Bookings::className(), ['id' => 'booking_id']);
    }
}
