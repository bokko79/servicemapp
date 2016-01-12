<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio".
 *
 * @property string $provider_id
 * @property string $name
 * @property string $description
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
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => 'Provider ID',
            'name' => 'Ime portfolia.',
            'description' => 'Tekst portfolia.',
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
    public function getProviderPortfolioImages()
    {
        return $this->hasMany(ProviderPortfolioImages::className(), ['provider_portfolio_id' => 'provider_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderPortfolioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderPortfolioQuery(get_called_class());
    }
}
