<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_industry_terms".
 *
 * @property string $provider_industry_id
 * @property string $ip_warranty
 * @property string $performance_warranty
 * @property string $invoicing
 * @property string $payment_methods
 * @property string $payment
 * @property integer $payment_advance_percentage
 * @property string $payment_at_once_time
 * @property integer $payment_installment_no_rates
 * @property integer $payment_installement_rate
 * @property integer $payment_installement_frequency
 * @property string $payment_installement_frequency_unit
 * @property string $liability
 * @property string $agreement_effective_until
 * @property string $cancellation_policy
 * @property string $update_time
 */
class ProviderIndustryTerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_industry_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_industry_id', 'update_time'], 'required'],
            [['provider_industry_id', 'payment_advance_percentage', 'payment_installment_no_rates', 'payment_installement_rate', 'payment_installement_frequency'], 'integer'],
            [['ip_warranty', 'performance_warranty', 'invoicing', 'payment_methods', 'payment', 'payment_at_once_time', 'payment_installement_frequency_unit', 'liability', 'agreement_effective_until', 'cancellation_policy'], 'string'],
            [['update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_industry_id' => Yii::t('app', 'Provider Industry ID'),
            'ip_warranty' => Yii::t('app', 'Ip Warranty'),
            'performance_warranty' => Yii::t('app', 'Performance Warranty'),
            'invoicing' => Yii::t('app', 'Invoicing'),
            'payment_methods' => Yii::t('app', 'Payment Methods'),
            'payment' => Yii::t('app', 'Payment'),
            'payment_advance_percentage' => Yii::t('app', 'Payment Advance Percentage'),
            'payment_at_once_time' => Yii::t('app', 'Payment At Once Time'),
            'payment_installment_no_rates' => Yii::t('app', 'Payment Installment No Rates'),
            'payment_installement_rate' => Yii::t('app', 'Payment Installement Rate'),
            'payment_installement_frequency' => Yii::t('app', 'Payment Installement Frequency'),
            'payment_installement_frequency_unit' => Yii::t('app', 'Payment Installement Frequency Unit'),
            'liability' => Yii::t('app', 'Liability'),
            'agreement_effective_until' => Yii::t('app', 'Agreement Effective Until'),
            'cancellation_policy' => Yii::t('app', 'Cancellation Policy'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderIndustry()
    {
        return $this->hasOne(ProviderIndustries::className(), ['id' => 'provider_industry_id']);
    }
}
