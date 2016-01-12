<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bid_term_expenses".
 *
 * @property string $id
 * @property string $bid_term_id
 * @property string $expense
 * @property string $expense_name
 * @property string $payable_by
 * @property string $amount
 *
 * @property BidTerms $bidTerm
 */
class BidTermExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_term_expenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_term_id', 'payable_by'], 'required'],
            [['bid_term_id'], 'integer'],
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
            'bid_term_id' => Yii::t('app', 'Bid Term ID'),
            'expense' => Yii::t('app', 'Expense'),
            'expense_name' => Yii::t('app', 'Expense Name'),
            'payable_by' => Yii::t('app', 'Payable By'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTerm()
    {
        return $this->hasOne(BidTerms::className(), ['bid_id' => 'bid_term_id']);
    }
}
