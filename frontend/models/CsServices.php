<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_services".
 *
 * @property integer $id
 * @property string $name
 * @property integer $industry_id
 * @property integer $action_id
 * @property string $action
 * @property integer $object_id
 * @property string $object_name
 * @property integer $unit_id
 * @property string $service_type
 * @property string $amount
 * @property string $pic
 * @property string $service_object
 * @property string $consumer_count
 * @property string $support
 * @property string $location
 * @property string $time
 * @property string $duration
 * @property string $turn_key
 * @property string $addinfo_tools
 * @property integer $skill_id
 * @property integer $regulation_id
 * @property string $labour_type
 * @property string $frequency
 * @property string $coverage
 * @property integer $process
 * @property integer $geospecific
 * @property string $dat
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 * @property string $hit_counter
 *
 * @property CsRecommendedServices[] $csRecommendedServices
 * @property CsRecommendedServices[] $csRecommendedServices0
 * @property CsServiceProcesses[] $csServiceProcesses
 * @property CsServiceRegulations[] $csServiceRegulations
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
            [['name', 'industry_id', 'action_id', 'action', 'object_id', 'object_name', 'unit_id', 'frequency', 'coverage'], 'required'],
            [['industry_id', 'action_id', 'object_id', 'unit_id', 'skill_id', 'regulation_id', 'process', 'geospecific', 'added_by', 'hit_counter'], 'integer'],
            [['dat', 'status'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 90],
            [['action'], 'string', 'max' => 80],
            [['object_name'], 'string', 'max' => 60],
            [['service_type', 'amount', 'pic', 'service_object', 'consumer_count', 'support', 'location', 'time', 'duration', 'turn_key', 'addinfo_tools', 'labour_type', 'frequency', 'coverage'], 'string', 'max' => 1]
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
            'industry_id' => Yii::t('app', 'Industry ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'action' => Yii::t('app', 'Action'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_name' => Yii::t('app', 'Object Name'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'service_type' => Yii::t('app', 'Service Type'),
            'amount' => Yii::t('app', 'Amount'),
            'pic' => Yii::t('app', 'Pic'),
            'service_object' => Yii::t('app', 'Service Object'),
            'consumer_count' => Yii::t('app', 'Consumer Count'),
            'support' => Yii::t('app', 'Support'),
            'location' => Yii::t('app', 'Location'),
            'time' => Yii::t('app', 'Time'),
            'duration' => Yii::t('app', 'Duration'),
            'turn_key' => Yii::t('app', 'Turn Key'),
            'addinfo_tools' => Yii::t('app', 'Addinfo Tools'),
            'skill_id' => Yii::t('app', 'Skill ID'),
            'regulation_id' => Yii::t('app', 'Regulation ID'),
            'labour_type' => Yii::t('app', 'Labour Type'),
            'frequency' => Yii::t('app', 'Frequency'),
            'coverage' => Yii::t('app', 'Coverage'),
            'process' => Yii::t('app', 'Process'),
            'geospecific' => Yii::t('app', 'Geospecific'),
            'dat' => Yii::t('app', 'Dat'),
            'status' => Yii::t('app', 'Status'),
            'added_by' => Yii::t('app', 'Added By'),
            'added_time' => Yii::t('app', 'Added Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRecommendedServices()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRecommendedServices0()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['rcmd_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceSpecs()
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
    public function getAction0()
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
    public function getCsServicesTranslations()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarServices()
    {
        return $this->hasMany(CsSimilarServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarServices0()
    {
        return $this->hasMany(CsSimilarServices::className(), ['sim_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['service_id' => 'id']);
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
}
