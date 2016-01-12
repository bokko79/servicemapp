<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_service_term_expenses".
 *
 * @property string $id
 * @property string $provider_service_term_id
 * @property string $expense
 * @property string $expense_name
 * @property string $payable_by
 * @property string $amount
 *
 * @property ProviderServiceTerms $providerServiceTerm
 */
class ProviderServiceTermExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_term_expenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_term_id', 'expense_name'], 'required'],
            [['provider_service_term_id'], 'integer'],
            [['expense', 'payable_by'], 'string'],
            [['amount'], 'number'],
            [['expense_name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_service_term_id' => Yii::t('app', 'Provider Service Term ID'),
            'expense' => Yii::t('app', 'Expense'),
            'expense_name' => Yii::t('app', 'Expense Name'),
            'payable_by' => Yii::t('app', 'Payable By'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTerm()
    {
        return $this->hasOne(ProviderServiceTerms::className(), ['provider_service_id' => 'provider_service_term_id']);
    }
}
