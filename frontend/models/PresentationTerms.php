<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_terms".
 *
 * @property string $presentation_id
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
 */
class PresentationTerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['presentation_id', 'update_time'], 'required'],
            [['presentation_id', 'payment_advance_percentage', 'payment_installment_no_rates', 'payment_installment_rate', 'payment_installment_frequency'], 'integer'],
            [['ip_warranty', 'performance_warranty', 'invoicing', 'payment_methods', 'payment', 'payment_at_once_time', 'payment_installment_frequency_unit', 'liability', 'agreement_effective_until', 'cancellation_policy'], 'string'],
            [['update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'ip_warranty' => Yii::t('app', 'Ip Warranty'),
            'performance_warranty' => Yii::t('app', 'Garancije da će ova usluga biti izvršena sa uloženim razumnim trudom i veštinom'),
            'invoicing' => Yii::t('app', 'Način fakturisanja za ugovorene troškove izvršenja usluge'),
            'payment_methods' => Yii::t('app', 'Način na koji ćete naplatiti izvršenje usluge'),
            'payment' => Yii::t('app', 'Payment'),
            'payment_advance_percentage' => Yii::t('app', 'Payment Advance Percentage'),
            'payment_at_once_time' => Yii::t('app', 'Kada se vrši naplata za ugovorenu cenu usluge?'),
            'payment_installment_no_rates' => Yii::t('app', 'Broj rata u koliko će ugovorena cena usluge biti naplaćena'),
            'payment_installment_rate' => Yii::t('app', 'Payment Installment Rate'),
            'payment_installment_frequency' => Yii::t('app', 'Učestalost naplate rata za ugovorenu cenu izvršenja usluge'),
            'payment_installment_frequency_unit' => Yii::t('app', 'Payment Installment Frequency Unit'),
            'liability' => Yii::t('app', 'Odgovornost za izvršenje usluge'),
            'agreement_effective_until' => Yii::t('app', 'Rok važenja sporazuma o izvršenju usluge'),
            'cancellation_policy' => Yii::t('app', 'Politika otkazivanja naručene usluge'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClauses()
    {
        return $this->hasMany(PresentationTermClauses::className(), ['presentation_term_id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses()
    {
        return $this->hasMany(PresentationTermExpenses::className(), ['presentation_term_id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMilestones()
    {
        return $this->hasMany(PresentationTermMilestones::className(), ['presentation_term_id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
