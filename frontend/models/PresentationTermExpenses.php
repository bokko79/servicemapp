<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_term_expenses".
 *
 * @property string $id
 * @property string $presentation_term_id
 * @property string $expense
 * @property string $expense_name
 * @property string $payable_by
 * @property string $amount
 */
class PresentationTermExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_term_expenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_term_id', 'expense_name'], 'required'],
            [['presentation_term_id'], 'integer'],
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
            'presentation_term_id' => 'Presentation Term ID',
            'expense' => 'Expense',
            'expense_name' => 'Expense Name',
            'payable_by' => 'Payable By',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationTerm()
    {
        return $this->hasOne(PresentationTerms::className(), ['presentation_id' => 'presentation_term_id']);
    }
}
