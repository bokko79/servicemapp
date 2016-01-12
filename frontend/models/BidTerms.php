<?php

namespace frontend\models;

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
            'bid_id' => Yii::t('app', 'Bid ID'),
            'ip_warranty' => Yii::t('app', 'Ip Warranty'),
            'performance_warranty' => Yii::t('app', 'Performance Warranty'),
            'invoicing' => Yii::t('app', 'Invoicing'),
            'payment_methods' => Yii::t('app', 'Payment Methods'),
            'payment' => Yii::t('app', 'Payment'),
            'payment_advance_percentage' => Yii::t('app', 'Payment Advance Percentage'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'payment_at_once_time' => Yii::t('app', 'Payment At Once Time'),
            'payment_installment_no_rates' => Yii::t('app', 'Payment Installment No Rates'),
            'payment_installment_rate' => Yii::t('app', 'Payment Installment Rate'),
            'payment_installment_frequency' => Yii::t('app', 'Payment Installment Frequency'),
            'payment_installment_frequency_unit' => Yii::t('app', 'Payment Installment Frequency Unit'),
            'liability' => Yii::t('app', 'Liability'),
            'agreement_effective_until' => Yii::t('app', 'Agreement Effective Until'),
            'cancellation_policy' => Yii::t('app', 'Cancellation Policy'),
            'term_time' => Yii::t('app', 'Term Time'),
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
}
