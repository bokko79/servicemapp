<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bid_term_milestones".
 *
 * @property string $id
 * @property string $bid_term_id
 * @property string $name
 * @property integer $percentage
 * @property string $amount
 * @property string $date
 *
 * @property BidTerms $bidTerm
 */
class BidTermMilestones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_term_milestones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_term_id', 'name'], 'required'],
            [['bid_term_id', 'percentage'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 40]
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
            'name' => 'Name',
            'percentage' => 'Percentage',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTerm()
    {
        return $this->hasOne(BidTerms::className(), ['bid_id' => 'bid_term_id']);
    }

    /**
     * @inheritdoc
     * @return BidTermMilestonesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BidTermMilestonesQuery(get_called_class());
    }
}
