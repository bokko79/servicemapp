<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_service_terms".
 *
 * @property string $provider_service_id
 * @property string $ip_warranty
 * @property string $performance_warranty
 * @property string $invoicing
 * @property string $payment_methods
 * @property string $payment
 * @property integer $payment_advance_percentage
 * @property string $payment_at_once_time
 * @property integer $payment_installment_no_rates
 * @property integer $payment_installment_rate
 * @property integer $payment_installment_frequency
 * @property string $payment_installment_frequency_unit
 * @property string $liability
 * @property string $agreement_effective_until
 * @property string $cancellation_policy
 * @property string $update_time
 *
 * @property ProviderServiceTermClauses[] $providerServiceTermClauses
 * @property ProviderServiceTermExpenses[] $providerServiceTermExpenses
 * @property ProviderServiceTermMilestones[] $providerServiceTermMilestones
 * @property ProviderServices $providerService
 */
class ProviderServiceTerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_id', 'update_time'], 'required'],
            [['provider_service_id', 'payment_advance_percentage', 'payment_installment_no_rates', 'payment_installment_rate', 'payment_installment_frequency'], 'integer'],
            [['ip_warranty', 'performance_warranty', 'invoicing', 'payment_methods', 'payment', 'payment_at_once_time', 'payment_installment_frequency_unit', 'liability', 'agreement_effective_until', 'cancellation_policy'], 'string'],
            [['update_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_service_id' => 'Usluga pružaoca.',
            'ip_warranty' => 'Garancije da nema povrede intelektualnih prava prilikom izvršenja usluge.',
            'performance_warranty' => 'Garancije na izvršenje usluge.',
            'invoicing' => 'Način izdavanja fakture.',
            'payment_methods' => 'Način primanja uplate.',
            'payment' => 'Način plaćanja. at_once - odjednom sve; installment - na rate; milestone - na faze; advance - avansna uplata.',
            'payment_advance_percentage' => 'Procenat avansne uplate.',
            'payment_at_once_time' => 'Vreme kada se plaća odjednom.',
            'payment_installment_no_rates' => 'Broj rata uplate.',
            'payment_installment_rate' => 'Visina rate uplate.',
            'payment_installment_frequency' => 'Učestalost kojom se plaćaju rate.',
            'payment_installment_frequency_unit' => 'Jedinica vremena učestalosti plaćanja rate usluge.',
            'liability' => 'Odgovornost za izvršenje usluge. none - bez odgovornosti; possible - za sporove nadležan sud; full - puna odgovornost pružaoca usluge.',
            'agreement_effective_until' => 'Rok važenja sporazuma.',
            'cancellation_policy' => 'Politika otkazivanja sporazuma.',
            'update_time' => 'Vreme podešavanja.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTermClauses()
    {
        return $this->hasMany(ProviderServiceTermClauses::className(), ['provider_service_term_id' => 'provider_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTermExpenses()
    {
        return $this->hasMany(ProviderServiceTermExpenses::className(), ['provider_service_term_id' => 'provider_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTermMilestones()
    {
        return $this->hasMany(ProviderServiceTermMilestones::className(), ['provider_service_term_id' => 'provider_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderService()
    {
        return $this->hasOne(ProviderServices::className(), ['id' => 'provider_service_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderServiceTermsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServiceTermsQuery(get_called_class());
    }
}
