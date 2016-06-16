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
            'id' => 'ID',
            'feedback_id' => 'Feedback ID',
            'booking_id' => 'Dogovor na osnovu kojeg se vrši ocenjivanje.',
            'provider_id' => 'Pružalac usluge koji ocenjuje korisnika.',
            'user_id' => 'Korisnik koji se ocenjuje.',
            'professionalism' => 'Profesionalnost korisnika. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'responsibility' => 'Odgovornost korisnika. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'concise' => 'Jasnoća zahtevanja korisnika. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'payment' => 'Plaćanje korisnika. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'nagging' => 'Zanovetanje korisnika. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'time' => 'Datum i vreme ocene korisnika.',
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

    /**
     * @inheritdoc
     * @return FeedbackOnUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackOnUserQuery(get_called_class());
    }
}
