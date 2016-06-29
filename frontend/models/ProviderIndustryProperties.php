<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_industry_skills".
 *
 * @property string $id
 * @property string $provider_industry_id
 * @property integer $industry_property_id
 * @property integer $property_value_id
 * @property string $description
 *
 * @property ProviderIndustries $providerIndustry
 * @property CsIndustryProperties $industryProperties
 */
class ProviderIndustryPropertes extends \yii\db\ActiveRecord
{
    public $selection = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_industry_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_industry_id', 'industry_property_id', 'property_value_id'], 'required'],
            [['provider_industry_id', 'industry_property_id', 'property_value_id'], 'integer'],
            [['selection'] , 'safe'],
            [['description'], 'string'],
            [['provider_industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderIndustries::className(), 'targetAttribute' => ['provider_industry_id' => 'id']],
            [['industry_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsIndustryProperties::className(), 'targetAttribute' => ['industry_property_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_industry_id' => 'Provider Industry ID',
            'industry_property_id' => 'Skill ID',
            'property_value_id' => 'Model',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderIndustry()
    {
        return $this->hasOne(ProviderIndustries::className(), ['id' => 'provider_industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustryProperty()
    {
        return $this->hasOne(CsIndustryProperties::className(), ['id' => 'industry_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }
}
