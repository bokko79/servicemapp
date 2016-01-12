<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $industry_id
 * @property string $legal_form
 * @property string $phone2
 * @property string $phone3
 * @property string $website
 * @property string $VAT_ID
 * @property string $company_no
 * @property string $bank_acc_no
 * @property string $work_time_start
 * @property string $work_time_end
 * @property string $registration_time
 * @property string $status
 * @property integer $is_active
 * @property string $del_upd_time
 * @property string $service_upd_time
 * @property integer $score
 * @property integer $rate
 * @property integer $rating
 * @property string $licence_no
 * @property string $licence_hash
 * @property string $licence_upd_time
 * @property string $hit_counter
 *
 * @property Banners[] $banners
 * @property FeedbackOnProvider[] $feedbackOnProviders
 * @property FeedbackOnUser[] $feedbackOnUsers
 * @property Orders[] $orders
 * @property User $user
 * @property CsIndustries $industry
 * @property ProviderComments[] $providerComments
 * @property ProviderLanguages[] $providerLanguages
 * @property ProviderLocations[] $providerLocations
 * @property ProviderPortfolio $providerPortfolio
 * @property ProviderRecommendation[] $providerRecommendations
 * @property ProviderServices[] $providerServices
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'legal_form', 'registration_time'], 'required'],
            [['user_id', 'industry_id', 'is_active', 'score', 'rate', 'rating', 'hit_counter'], 'integer'],
            [['legal_form', 'status'], 'string'],
            [['work_time_start', 'work_time_end', 'registration_time', 'del_upd_time', 'service_upd_time', 'licence_upd_time'], 'safe'],
            [['phone2', 'phone3', 'VAT_ID', 'company_no'], 'string', 'max' => 20],
            [['website'], 'string', 'max' => 50],
            [['bank_acc_no', 'licence_no'], 'string', 'max' => 30],
            [['licence_hash'], 'string', 'max' => 13],
            [['user_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'industry_id' => 'Pretežna uslužna delatnost pružaoca usluge.',
            'legal_form' => 'Pravni oblik pružaoca usluge. fizičko - fizičko lice; pravno - pravno lice.',
            'phone2' => 'Alternativni telefon 2.',
            'phone3' => 'Alternativni telefon 3.',
            'website' => 'Website pružaoca usluge.',
            'VAT_ID' => 'Poreski identifikacioni broj pružaoca usluge (PIB).',
            'company_no' => 'Matični broj preduzeća pružaoca usluge. ',
            'bank_acc_no' => 'Broj primarnog bankovnog računa.',
            'work_time_start' => 'Početak radnog vremena.',
            'work_time_end' => 'Kraj radnog vremena.',
            'registration_time' => 'Datum registracije pružaoca usluge.',
            'status' => 'Status pružaoca usluge. aktivan, banovan, neaktivan, u mirovanju. ',
            'is_active' => 'Aktivnost pružaoca usluge. 0 - ne; 1 - da.',
            'del_upd_time' => 'Datum i vreme izmene pretežne delatnosti.',
            'service_upd_time' => 'Datum i vreme izmene pružajućih usluga.',
            'score' => 'Score pružaoca usluge.',
            'rate' => 'Ocena pružaoca usluge.',
            'rating' => 'Rejting pružaoca usluge.',
            'licence_no' => 'Broj licence ili dozvole pružaoca usluge.',
            'licence_hash' => 'Kod za potvrdu licence ili dozvole pružaoca usluge.',
            'licence_upd_time' => 'Datum i vreme unosa licence pružaoca usluge.',
            'hit_counter' => 'Broj poseta profila pružaoca usluge.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnProviders()
    {
        return $this->hasMany(FeedbackOnProvider::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnUsers()
    {
        return $this->hasMany(FeedbackOnUser::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['registered_to' => 'id']);
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
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderComments()
    {
        return $this->hasMany(ProviderComments::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderLanguages()
    {
        return $this->hasMany(ProviderLanguages::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderLocations()
    {
        return $this->hasMany(ProviderLocations::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolio()
    {
        return $this->hasOne(ProviderPortfolio::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderRecommendations()
    {
        return $this->hasMany(ProviderRecommendation::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['provider_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProviderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderQuery(get_called_class());
    }
}
