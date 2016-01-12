<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback_on_provider".
 *
 * @property string $id
 * @property string $feedback_id
 * @property string $agreement_id
 * @property string $user_id
 * @property string $provider_id
 * @property string $price
 * @property string $quality
 * @property string $responsiveness
 * @property string $punctuality
 * @property string $professionalism
 * @property string $time
 *
 * @property Provider $provider
 * @property User $user
 * @property Feedback $feedback
 * @property Agreements $agreement
 */
class FeedbackOnProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback_on_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'agreement_id', 'user_id', 'provider_id', 'time'], 'required'],
            [['feedback_id', 'agreement_id', 'user_id', 'provider_id'], 'integer'],
            [['price', 'quality', 'responsiveness', 'punctuality', 'professionalism'], 'string'],
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
            'agreement_id' => 'Dogovor na osnovu kojeg se vrši ocenjivanje.',
            'user_id' => 'Korisnik koji ocenjuje pružaoca usluge.',
            'provider_id' => 'Pružalac usluge koji se ocenjuje.',
            'price' => 'Cena pružaoca usluge. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'quality' => 'Kvalitet izvršenja usluge. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'responsiveness' => 'Odazivanje na izvršenje usluge. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'punctuality' => 'Tačnost pri izvršenju usluge. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'professionalism' => 'Profesionalnost. 1 - nedovoljno; 2 - dovoljno; 3 - dobro; 4 - vrlo dobro; 5 - odlično.',
            'time' => 'Datum i vreme ocene pružaoca usluge.',
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
    public function getAgreement()
    {
        return $this->hasOne(Agreements::className(), ['id' => 'agreement_id']);
    }

    /**
     * @inheritdoc
     * @return FeedbackOnProviderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackOnProviderQuery(get_called_class());
    }
}
