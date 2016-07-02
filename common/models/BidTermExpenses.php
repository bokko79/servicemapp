<?php

namespace common\models;

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
            'id' => 'ID',
            'bid_term_id' => 'Bid Term ID',
            'expense' => 'Gotovinski trošak, dodatan na cenu usluge.',
            'expense_name' => 'Gotovinski trošak, ime.',
            'payable_by' => 'Snositelj troška.',
            'amount' => 'Iznos gotovinskog troška.',
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
