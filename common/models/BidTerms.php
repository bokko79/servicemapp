<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bid_terms".
 *
 * @property string $bid_id
 * @property string $ip_warranty
 * @property string $performance_warranty
 * @property string $invoicing
 * @property string $payment_methods
 * @property string $payment
 * @property integer $payment_advance_percentage
 * @property string $payment_date
 * @property string $payment_at_once_time
 * @property integer $payment_installment_no_rates
 * @property integer $payment_installment_rate
 * @property integer $payment_installment_frequency
 * @property string $payment_installment_frequency_unit
 * @property string $liability
 * @property string $agreement_effective_until
 * @property string $cancellation_policy
 * @property string $term_time
 *
 * @property BidTermClauses[] $bidTermClauses
 * @property BidTermExpenses[] $bidTermExpenses
 * @property BidTermMilestones[] $bidTermMilestones
 * @property Bids $bid
 */
class BidTerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_id', 'payment_date', 'agreement_effective_until', 'term_time'], 'required'],
            [['bid_id', 'payment_advance_percentage', 'payment_installment_no_rates', 'payment_installment_rate', 'payment_installment_frequency'], 'integer'],
            [['ip_warranty', 'performance_warranty', 'invoicing', 'payment_methods', 'payment', 'payment_at_once_time', 'payment_installment_frequency_unit', 'liability', 'agreement_effective_until', 'cancellation_policy'], 'string'],
            [['payment_date', 'term_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bid_id' => 'Ponuda.',
            'ip_warranty' => 'Garancije da nema povrede intelektualnih prava prilikom izvršenja usluge.',
            'performance_warranty' => 'Garancije na izvršenje usluge.',
            'invoicing' => 'Način izdavanja fakture.',
            'payment_methods' => 'Način primanja uplate.',
            'payment' => 'Način plaćanja. at_once - odjednom sve; installment - na rate; milestone - na faze; advance - avansna uplata.',
            'payment_advance_percentage' => 'Procenat avansne uplate.',
            'payment_date' => 'Datum plaćanja usluge.',
            'payment_at_once_time' => 'Vreme kada se plaća odjednom.',
            'payment_installment_no_rates' => 'Broj rata uplate.',
            'payment_installment_rate' => 'Visina rate uplate.',
            'payment_installment_frequency' => 'Učestalost kojom se plaćaju rate.',
            'payment_installment_frequency_unit' => 'Jedinica vremena učestalosti plaćanja rate usluge.',
            'liability' => 'Odgovornost za izvršenje usluge. none - bez odgovornosti; possible - za sporove nadležan sud; full - puna odgovornost pružaoca usluge.',
            'agreement_effective_until' => 'Rok važenja sporazuma.',
            'cancellation_policy' => 'Politika otkazivanja sporazuma.',
            'term_time' => 'Term Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTermClauses()
    {
        return $this->hasMany(BidTermClauses::className(), ['bid_term_id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTermExpenses()
    {
        return $this->hasMany(BidTermExpenses::className(), ['bid_term_id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTermMilestones()
    {
        return $this->hasMany(BidTermMilestones::className(), ['bid_term_id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBid()
    {
        return $this->hasOne(Bids::className(), ['id' => 'bid_id']);
    }

    /**
     * @inheritdoc
     * @return BidTermsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BidTermsQuery(get_called_class());
    }
}
