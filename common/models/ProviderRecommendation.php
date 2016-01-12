<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_recommendation".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $user_id
 * @property string $time
 *
 * @property Provider $provider
 * @property User $user
 */
class ProviderRecommendation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_recommendation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'user_id', 'time'], 'required'],
            [['provider_id', 'user_id'], 'integer'],
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
            'provider_id' => 'Pružalac usluge koji se preporučuje.',
            'user_id' => 'Korisnik koji preporučuje pružaoca usluge.',
            'time' => 'Datum i vreme preporuke.',
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
     * @inheritdoc
     * @return ProviderRecommendationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderRecommendationQuery(get_called_class());
    }
}
