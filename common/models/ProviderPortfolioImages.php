<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio_images".
 *
 * @property string $id
 * @property string $provider_portfolio_id
 * @property string $image_id
 * @property string $description
 *
 * @property Images $image
 * @property ProviderPortfolio $providerPortfolio
 */
class ProviderPortfolioImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_portfolio_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_portfolio_id', 'image_id'], 'required'],
            [['provider_portfolio_id', 'image_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_portfolio_id' => 'Portfolio pružaoca usluge.',
            'image_id' => 'Slika/dokument.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolio()
    {
        return $this->hasOne(ProviderPortfolio::className(), ['provider_id' => 'provider_portfolio_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderPortfolioImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderPortfolioImagesQuery(get_called_class());
    }
}
