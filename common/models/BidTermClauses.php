<?php

namespace common\models;

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
            'id' => 'ID',
            'bid_term_id' => 'Bid Term ID',
            'clause_title' => 'Naslov dodatne stavke sporazuma.',
            'clause_text' => 'Tekst dodatne stavke sporazuma.',
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
