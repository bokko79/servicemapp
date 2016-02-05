<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_industries".
 *
 * @property string $id
 * @property string $provider_id
 * @property integer $industry_id
 * @property integer $main
 *
 * @property Provider $provider
 * @property CsIndustries $industry
 * @property ProviderIndustrySkills[] $providerIndustrySkills
 * @property ProviderServices[] $providerServices
 */
class ProviderIndustries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_industries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'industry_id'], 'required'],
            [['provider_id', 'industry_id', 'main'], 'integer'],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
            [['industry_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsIndustries::className(), 'targetAttribute' => ['industry_id' => 'id']],
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
            'industry_id' => 'Industry ID',
            'main' => 'Main',
        ];
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
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderIndustrySkills()
    {
        return $this->hasMany(ProviderIndustrySkills::className(), ['provider_industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['provider_industry_id' => 'id']);
    }
}
