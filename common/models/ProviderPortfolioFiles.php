<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio_files".
 *
 * @property string $id
 * @property string $provider_portfolio_id
 * @property string $file_id
 *
 * @property Images $image
 * @property ProviderPortfolio $providerPortfolio
 */
class ProviderPortfolioFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_portfolio_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_portfolio_id', 'file_id'], 'required'],
            [['provider_portfolio_id', 'file_id'], 'integer'],
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
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolio()
    {
        return $this->hasOne(ProviderPortfolio::className(), ['provider_id' => 'provider_portfolio_id']);
    }
}
