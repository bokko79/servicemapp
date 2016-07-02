<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_portfolio_experience".
 *
 * @property string $id
 * @property string $provider_portfolio_id
 * @property string $title
 * @property string $company
 * @property string $start_month
 * @property integer $start_year
 * @property integer $current
 * @property string $end_month
 * @property integer $end_year
 * @property string $summary
 */
class ProviderPortfolioExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_portfolio_experience';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_portfolio_id', 'title', 'company', 'start_month', 'start_year', 'end_month', 'end_year', 'summary'], 'required'],
            [['provider_portfolio_id', 'start_year', 'current', 'end_year'], 'integer'],
            [['summary'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['company'], 'string', 'max' => 128],
            [['start_month', 'end_month'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_portfolio_id' => 'Provider Portfolio ID',
            'title' => 'Title',
            'company' => 'Company',
            'start_month' => 'Start Month',
            'start_year' => 'Start Year',
            'current' => 'Current',
            'end_month' => 'End Month',
            'end_year' => 'End Year',
            'summary' => 'Summary',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolio()
    {
        return $this->hasOne(ProviderPortfolio::className(), ['provider_id' => 'provider_portfolio_id']);
    }
}
