<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio".
 *
 * @property string $provider_id
 * @property string $name
 *
 * @property Provider $provider
 * @property ProviderPortfolioImages[] $providerPortfolioImages
 */
class ProviderPortfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'name'], 'required'],
            [['provider_id'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => Yii::t('app', 'Provider ID'),
            'name' => Yii::t('app', 'Name'),
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
    public function getProviderPortfolioCertifications()
    {
        return $this->hasMany(ProviderPortfolioCertifications::className(), ['provider_portfolio_id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioEducations()
    {
        return $this->hasMany(ProviderPortfolioEducations::className(), ['provider_portfolio_id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioExperience()
    {
        return $this->hasMany(ProviderPortfolioExperience::className(), ['provider_portfolio_id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioImages()
    {
        return $this->hasMany(ProviderPortfolioImages::className(), ['provider_portfolio_id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioPublications()
    {
        return $this->hasMany(ProviderPortfolioPublications::className(), ['provider_portfolio_id' => 'provider_id']);
    }
}
