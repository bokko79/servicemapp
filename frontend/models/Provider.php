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
 * @property string $type
 * @property string $loc_id
 * @property string $parent
 * @property string $department_name
 * @property string $department_type
 * @property string $legal_name
 * @property string $image_id
 * @property integer $coverage
 * @property string $coverage_within
 * @property string $name
 * @property string $VAT_ID
 * @property string $company_no 
 * @property string $registration_time
 * @property string $status
 * @property integer $is_active
 * @property string $del_upd_time
 * @property string $service_upd_time
 * @property integer $score
 * @property string $rate
 * @property string $rating
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
            [['user_id', 'legal_form', 'loc_id', 'registration_time'], 'required'],
           [['user_id', 'industry_id', 'loc_id', 'parent', 'image_id', 'coverage', 'is_active', 'score', 'hit_counter'], 'integer'],
           [['legal_form', 'type', 'department_type', 'status'], 'string'],
           [['coverage_within', 'rate', 'rating'], 'number'],
           [['registration_time', 'del_upd_time', 'service_upd_time'], 'safe'],
           [['department_name', 'legal_name'], 'string', 'max' => 80],
           [['name'], 'string', 'max' => 64],
           [['VAT_ID', 'company_no'], 'string', 'max' => 20],
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
            'type' => Yii::t('app', 'Type'),
           'loc_id' => Yii::t('app', 'Loc ID'),
           'parent' => Yii::t('app', 'Parent'),
           'department_name' => Yii::t('app', 'Department Name'),
           'department_type' => Yii::t('app', 'Department Type'),
           'legal_name' => Yii::t('app', 'Legal Name'),
           'image_id' => Yii::t('app', 'Image ID'),
           'coverage' => Yii::t('app', 'Coverage'),
           'coverage_within' => Yii::t('app', 'Coverage Within'),
           'name' => Yii::t('app', 'Name'),
            'VAT_ID' => Yii::t('app', 'Vat  ID'),
            'company_no' => Yii::t('app', 'Company No'),            
            'registration_time' => Yii::t('app', 'Registration Time'),
            'status' => Yii::t('app', 'Status'),
            'is_active' => Yii::t('app', 'Is Active'),
            'del_upd_time' => Yii::t('app', 'Del Upd Time'),
            'service_upd_time' => Yii::t('app', 'Service Upd Time'),
            'score' => Yii::t('app', 'Score'),
            'rate' => Yii::t('app', 'Rate'),
            'rating' => Yii::t('app', 'Rating'),           
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
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
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
    public function getAccounts()
    {
        return $this->hasMany(ProviderAccounts::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasMany(ProviderContact::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicences()
    {
        return $this->hasMany(ProviderLicences::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(ProviderMembers::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(ProviderNotifications::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpeningHours()
    {
        return $this->hasMany(ProviderOpeningHours::className(), ['provider_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function presWithSameAction($action_id)
    {
        $actContainer = [];
        if($presentations = $this->presentations){
            foreach($presentations as $presentation){
                if($presentation->pService->action_id==$action_id){
                    $actContainer[] = $presentation;
                }
            }            
        }
        return $actContainer;
    }
}
