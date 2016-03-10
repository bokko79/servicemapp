<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_industry_skills".
 *
 * @property string $id
 * @property string $provider_industry_id
 * @property integer $skill_id
 * @property integer $property_model_id
 * @property string $description
 *
 * @property ProviderIndustries $providerIndustry
 * @property CsSkills $skill
 */
class ProviderIndustrySkills extends \yii\db\ActiveRecord
{
    public $selection = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_industry_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_industry_id', 'skill_id', 'property_model_id'], 'required'],
            [['provider_industry_id', 'skill_id', 'property_model_id'], 'integer'],
            [['selection'] , 'safe'],
            [['description'], 'string'],
            [['provider_industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderIndustries::className(), 'targetAttribute' => ['provider_industry_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsSkills::className(), 'targetAttribute' => ['skill_id' => 'id']],
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
            'skill_id' => 'Skill ID',
            'property_model_id' => 'Model',
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
    public function getSkill()
    {
        return $this->hasOne(CsSkills::className(), ['id' => 'skill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'property_model_id']);
    }
}
