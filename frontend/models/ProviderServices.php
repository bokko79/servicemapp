<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_services".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $provider_industry_id
 * @property integer $service_id
 * @property integer $industry_id
 * @property integer $is_set
 * @property string $update_time
 *
 * @property OrderServices[] $orderServices
 * @property Presentations[] $presentations
 * @property PromotionServices[] $promotionServices
 * @property Provider $provider
 * @property CsServices $service
 * @property CsIndustries $industry
 * @property ProviderIndustries $providerIndustry
 */
class ProviderServices extends \yii\db\ActiveRecord
{   
    public $selection = [];
    public $object_model;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'provider_industry_id', 'service_id', 'industry_id', 'update_time'], 'required'],
            [['provider_id', 'provider_industry_id', 'service_id', 'industry_id', 'is_set'], 'integer'],
            [['update_time'], 'safe'], 
            [['selection'], 'safe'],  
            [['object_model'], 'safe'],          
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsServices::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsIndustries::className(), 'targetAttribute' => ['industry_id' => 'id']],
            [['provider_industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderIndustries::className(), 'targetAttribute' => ['provider_industry_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_id' => 'Provider ID',
            'provider_industry_id' => 'Provider Industry ID',
            'service_id' => 'Service ID',
            'industry_id' => 'Industry ID',
            'is_set' => 'Is Set',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['provider_service_id' => 'id']);
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
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
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
    public function getProviderIndustry()
    {
        return $this->hasOne(ProviderIndustries::className(), ['id' => 'provider_industry_id']);
    }
}
