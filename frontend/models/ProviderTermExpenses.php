<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_term_expenses".
 *
 * @property string $id
 * @property string $provider_term_id
 * @property string $expense
 * @property string $expense_name
 * @property string $payable_by
 * @property string $amount
 */
class ProviderTermExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_term_expenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_term_id', 'expense_name'], 'required'],
            [['provider_term_id'], 'integer'],
            [['expense', 'payable_by'], 'string'],
            [['amount'], 'number'],
            [['expense_name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_term_id' => 'Provider Term ID',
            'expense' => 'Expense',
            'expense_name' => 'Expense Name',
            'payable_by' => 'Payable By',
            'amount' => 'Amount',
        ];
    }
}
