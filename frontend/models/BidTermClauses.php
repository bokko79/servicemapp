<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bid_term_clauses".
 *
 * @property string $id
 * @property string $bid_term_id
 * @property string $clause_title
 * @property string $clause_text
 *
 * @property BidTerms $bidTerm
 */
class BidTermClauses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_term_clauses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_term_id', 'clause_title', 'clause_text'], 'required'],
            [['bid_term_id'], 'integer'],
            [['clause_text'], 'string'],
            [['clause_title'], 'string', 'max' => 120]
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
            'clause_title' => Yii::t('app', 'Clause Title'),
            'clause_text' => Yii::t('app', 'Clause Text'),
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
