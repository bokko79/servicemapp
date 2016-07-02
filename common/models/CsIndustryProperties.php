<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_industry_properties".
 *
 * @property integer $id
 * @property integer $industry_id
 * @property string $industry_name
 * @property integer $property_id
 * @property string $property_name
 * @property string $value_default
 * @property integer $value_min
 * @property string $value_max
 * @property string $step
 * @property string $pattern
 * @property integer $display_order
 * @property integer $multiple_values
 * @property integer $read_only
 * @property integer $required
 *
 * @property CsIndustries $industry
 * @property CsProperties $property
 * @property ProviderIndustrySkills[] $providerIndustrySkills
 */
class CsIndustryProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_industry_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_id', 'property_id'], 'required'],
            [['industry_id', 'property_id', 'value_min', 'value_max', 'display_order', 'multiple_values', 'read_only', 'required'], 'integer'],
            [['step'], 'number'],
            [['industry_name', 'property_name'], 'string', 'max' => 64],
            [['value_default'], 'string', 'max' => 128],
            [['pattern'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
            'industry_name' => Yii::t('app', 'Industry Name'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'value_default' => Yii::t('app', 'Value Default'),
            'value_min' => Yii::t('app', 'Value Min'),
            'value_max' => Yii::t('app', 'Value Max'),
            'step' => Yii::t('app', 'Step'),
            'pattern' => Yii::t('app', 'Pattern'),
            'display_order' => Yii::t('app', 'Display Order'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'read_only' => Yii::t('app', 'Read Only'),
            'required' => Yii::t('app', 'Required'),
        ];
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
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIndustryProperties()
    {
        return $this->hasMany(OrderIndustryProperties::className(), ['industry_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceIndustryProperties()
    {
        return $this->hasMany(CsServiceIndustryProperties::className(), ['industry_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function serviceIndustryProperty($service_id)
    {
        return \common\models\CsServiceIndustryProperties::find()->where('industry_property_id='.$this->id.' AND service_id='.$service_id)->one();
    }

    /**
     * @inheritdoc
     * @return CsSkillsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSkillsQuery(get_called_class());
    }
}
