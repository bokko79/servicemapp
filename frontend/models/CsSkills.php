<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_skills".
 *
 * @property integer $id
 * @property integer $industry_id
 * @property integer $property_id
 * @property string $property_name
 * @property integer $required
 * @property string $description
 *
 * @property CsIndustries $industry
 * @property CsProperties $property
 * @property ProviderIndustrySkills[] $providerIndustrySkills
 */
class CsSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_id', 'property_id'], 'required'],
            [['industry_id', 'property_id', 'required', 'display_order', ], 'integer'],
            [['description', 'pattern'], 'string'],
            [['range_min', 'range_max', 'range_step'], 'number'],
            [['industry_name', 'property_name'], 'string', 'max' => 64],
            [['default_value'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'industry_name' => Yii::t('app', 'Industry'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property'),
            'default_value' => Yii::t('app', 'Default Value'),
            'range_min' => Yii::t('app', 'Range Min'),
            'range_max' => Yii::t('app', 'Range Max'),
            'range_step' => Yii::t('app', 'Range Step'),
            'pattern' => Yii::t('app', 'Pattern'),
            'display_order' => Yii::t('app', 'Display order'),
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
    public function getOrderSkills()
    {
        return $this->hasMany(OrderSkills::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceSkills()
    {
        return $this->hasMany(CsServiceSkills::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function serviceSkill($service_id)
    {
        return \frontend\models\CsServiceSkills::find()->where('skill_id='.$this->id.' AND service_id='.$service_id)->one();
    }
}
