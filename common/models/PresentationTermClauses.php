<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_term_clauses".
 *
 * @property string $id
 * @property string $presentation_term_id
 * @property string $clause_title
 * @property string $clause_text
 * @property string $clause_time
 */
class PresentationTermClauses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_term_clauses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_term_id', 'clause_title', 'clause_text', 'clause_time'], 'required'],
            [['presentation_term_id'], 'integer'],
            [['clause_text'], 'string'],
            [['clause_time'], 'safe'],
            [['clause_title'], 'string', 'max' => 120],
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
            'clause_title' => 'Clause Title',
            'clause_text' => 'Clause Text',
            'clause_time' => 'Clause Time',
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
