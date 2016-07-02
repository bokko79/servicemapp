<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio_images".
 *
 * @property string $id
 * @property string $provider_portfolio_id
 * @property string $image_id
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_portfolio_id' => Yii::t('app', 'Provider Portfolio ID'),
            'image_id' => Yii::t('app', 'Image ID'),
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
}
