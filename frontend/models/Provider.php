<?php

namespace frontend\models;

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
 * @property ProviderIndustries[] $providerIndustries
 * @property ProviderLanguages[] $providerLanguages
 * @property ProviderLocations[] $providerLocations
 * @property ProviderPortfolio $providerPortfolio
 * @property ProviderRecommendation[] $providerRecommendations
 * @property ProviderServices[] $providerServices
 * @property ProviderTerms $providerTerms
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
            [['user_id', 'registration_time'], 'required'],
            [['user_id', 'industry_id', 'is_active', 'score', 'rate', 'rating', 'hit_counter'], 'integer'],
            [['legal_form', 'status'], 'string'],
            [['work_time_start', 'work_time_end', 'registration_time', 'del_upd_time', 'service_upd_time', 'licence_upd_time'], 'safe'],
            [['phone2', 'phone3', 'VAT_ID', 'company_no'], 'string', 'max' => 20],
            [['website'], 'string', 'max' => 50],
            [['bank_acc_no', 'licence_no'], 'string', 'max' => 30],
            [['licence_hash'], 'string', 'max' => 13],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsIndustries::className(), 'targetAttribute' => ['industry_id' => 'id']],
            [['registration_time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
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
            'industry_id' => Yii::t('app', 'Industry ID'),
            'legal_form' => Yii::t('app', 'Legal Form'),
            'phone2' => Yii::t('app', 'Phone2'),
            'phone3' => Yii::t('app', 'Phone3'),
            'website' => Yii::t('app', 'Website'),
            'VAT_ID' => Yii::t('app', 'Vat  ID'),
            'company_no' => Yii::t('app', 'Company No'),
            'bank_acc_no' => Yii::t('app', 'Bank Acc No'),
            'work_time_start' => Yii::t('app', 'Work Time Start'),
            'work_time_end' => Yii::t('app', 'Work Time End'),
            'registration_time' => Yii::t('app', 'Registration Time'),
            'status' => Yii::t('app', 'Status'),
            'is_active' => Yii::t('app', 'Is Active'),
            'del_upd_time' => Yii::t('app', 'Del Upd Time'),
            'service_upd_time' => Yii::t('app', 'Service Upd Time'),
            'score' => Yii::t('app', 'Score'),
            'rate' => Yii::t('app', 'Rate'),
            'rating' => Yii::t('app', 'Rating'),
            'licence_no' => Yii::t('app', 'Licence No'),
            'licence_hash' => Yii::t('app', 'Licence Hash'),
            'licence_upd_time' => Yii::t('app', 'Licence Upd Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
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
    public function getComments()
    {
        return $this->hasMany(ProviderComments::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustries()
    {
        return $this->hasMany(ProviderIndustries::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(ProviderLanguages::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(ProviderLocations::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolio()
    {
        return $this->hasOne(ProviderPortfolio::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendations()
    {
        return $this->hasMany(ProviderRecommendation::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(ProviderServices::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasOne(ProviderTerms::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuickCounts()
    {
        return '<i class="fa fa-thumbs-o-up"></i> '.count($this->recommendations). ' | 
                <i class="fa fa-comment-o"></i> '.count($this->comments);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function presWithSameObject($object_id)
    {
        $objContainer = [];
        if($presentations = $this->presentations){
            foreach($presentations as $presentation){
                if($presentation->object_id==$object_id){
                    $objContainer[] = $presentation;
                }
            }            
        }
        return $objContainer;
    }
}
