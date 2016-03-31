<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_services".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_id
 * @property integer $industry_id
 * @property integer $action_id
 * @property string $action_name
 * @property integer $object_id
 * @property string $object_name
 * @property integer $object_model_relevance 
 * @property string $service_type
 * @property integer $unit_id
 * @property string $amount
 * @property integer $amount_default 
 * @property integer $amount_range_min 
 * @property integer $amount_range_max 
 * @property string $amount_range_step 
 * @property string $consumer 
 * @property string $consumer_children 
 * @property integer $consumer_default 
 * @property integer $consumer_range_min 
 * @property integer $consumer_range_max 
 * @property string $consumer_range_step 
 * @property string $service_object 
 * @property string $pic
 * @property string $location
 * @property string $time
 * @property string $duration
 * @property string $frequency 
 * @property string $support 
 * @property string $turn_key
 * @property string $tools
 * @property string $labour_type
 * @property string $frequency
 * @property string $coverage
 * @property integer $geospecific 
 * @property integer $process
 * @property string $dat
 * @property string $availability 
 * @property string $ordering 
 * @property string $pricing 
 * @property string $terms 
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 * @property string $hit_counter
 *
 * @property CsRecommendedServices[] $csRecommendedServices
 * @property CsRecommendedServices[] $csRecommendedServices0
 * @property CsServiceProcesses[] $csServiceProcesses
 * @property CsServiceRegulations[] $csServiceRegulations
 * @property CsServiceMethods[] $csServiceMethods
 * @property CsServiceSpecs[] $csServiceSpecs
 * @property CsObjects $object
 * @property CsUnits $unit
 * @property CsActions $action0
 * @property CsIndustries $industry
 * @property User $addedBy
 * @property CsServicesTranslation[] $csServicesTranslations
 * @property CsSimilarServices[] $csSimilarServices
 * @property CsSimilarServices[] $csSimilarServices0
 * @property OrderServices[] $orderServices
 * @property PromotionServices[] $promotionServices
 * @property ProviderServices[] $providerServices
 * @property ServiceComments[] $serviceComments
 * @property UserServices[] $userServices
 */
class CsServices extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'industry_id', 'action_id', 'action_name', 'object_id', 'object_name', 'unit_id', 'coverage'], 'required'],
            [['image_id', 'industry_id', 'action_id', 'object_id', 'object_model_relevance', 'unit_id', 'amount_default', 'amount_range_min', 'amount_range_max', 'consumer_default', 'consumer_range_min', 'consumer_range_max', 'geospecific', 'process', 'added_by', 'hit_counter'], 'integer'],
            [['amount_range_step', 'consumer_range_step'], 'number'], 
            [['dat', 'status'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 90],
            [['action_name'], 'string', 'max' => 80],
            [['object_name'], 'string', 'max' => 60],
            [['service_type', 'amount', 'consumer', 'consumer_children', 'service_object', 'pic', 'location', 'time', 'duration', 'frequency', 'support', 'turn_key', 'tools', 'labour_type', 'coverage', 'availability', 'ordering', 'pricing', 'terms'], 'string', 'max' => 1],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image_id' => Yii::t('app', 'Image ID'), 
            'industry_id' => Yii::t('app', 'Industry ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'action_name' => Yii::t('app', 'Action'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_name' => Yii::t('app', 'Object Name'),
            'object_model_relevance' => Yii::t('app', 'Object Model Relevance'), 
            'service_type' => Yii::t('app', 'Service Type'), 
            'amount' => Yii::t('app', 'Amount'),
            'amount_default' => Yii::t('app', 'Amount Default'), 
            'amount_range_min' => Yii::t('app', 'Amount Range Min'), 
            'amount_range_max' => Yii::t('app', 'Amount Range Max'), 
            'amount_range_step' => Yii::t('app', 'Amount Range Step'), 
            'consumer' => Yii::t('app', 'Consumer'), 
            'consumer_children' => Yii::t('app', 'Consumer Children'), 
            'consumer_default' => Yii::t('app', 'Consumer Default'), 
            'consumer_range_min' => Yii::t('app', 'Consumer Range Min'), 
            'consumer_range_max' => Yii::t('app', 'Consumer Range Max'), 
            'consumer_range_step' => Yii::t('app', 'Consumer Range Step'), 
            'service_object' => Yii::t('app', 'Service Object'), 
            'pic' => Yii::t('app', 'Pic'),
            'location' => Yii::t('app', 'Location'),
            'time' => Yii::t('app', 'Time'),
            'duration' => Yii::t('app', 'Duration'),
            'frequency' => Yii::t('app', 'Frequency'), 
            'support' => Yii::t('app', 'Support'), 
            'turn_key' => Yii::t('app', 'Turn Key'),
            'tools' => Yii::t('app', 'Tools'),
            'labour_type' => Yii::t('app', 'Labour Type'),
            'coverage' => Yii::t('app', 'Coverage'),
            'geospecific' => Yii::t('app', 'Geospecific'), 
            'process' => Yii::t('app', 'Process'),
            'dat' => Yii::t('app', 'Dat'),
            'availability' => Yii::t('app', 'Availability'), 
            'ordering' => Yii::t('app', 'Ordering'), 
            'pricing' => Yii::t('app', 'Pricing'), 
            'terms' => Yii::t('app', 'Terms'), 
            'status' => Yii::t('app', 'Status'),
            'added_by' => Yii::t('app', 'Added By'),
            'added_time' => Yii::t('app', 'Added Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedServices()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedServices0()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['rcmd_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceMethods()
    {
        return $this->hasMany(CsServiceMethods::className(), ['service_id' => 'id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceSpecs()
    {
        return $this->hasMany(CsServiceSpecs::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(CsServiceUnits::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
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
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarServices()
    {
        return $this->hasMany(CsSimilarServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarServices0()
    {
        return $this->hasMany(CsSimilarServices::className(), ['sim_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(OrderServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceComments()
    {
        return $this->hasMany(ServiceComments::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServices()
    {
        return $this->hasMany(UserServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return ($this->object->image) ? $this->object->image->ime : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAveragePrice()
    {
        return '2.499,99&nbsp;RSD/m<sup>2</sup>';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $service_translation = \frontend\models\CsServicesTranslation::find()->where('lang_code="SR" and service_id='.$this->id)->one();
        if($service_translation) {
            return $service_translation;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTName()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSCaseName()
    {
        return Yii::$app->operator->sentenceCase($this->tName); 
    }
}
