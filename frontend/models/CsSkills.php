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
            [['industry_id', 'property_id', 'required'], 'integer'],
            [['description'], 'string'],
            [['industry_name', 'property_name'], 'string', 'max' => 64],
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
}
