<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_term_clauses".
 *
 * @property string $id
 * @property string $provider_term_id
 * @property string $clause_title
 * @property string $clause_text
 * @property string $clause_time
 */
class ProviderTermClauses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_term_clauses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_term_id', 'clause_title', 'clause_text', 'clause_time'], 'required'],
            [['provider_term_id'], 'integer'],
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
            'provider_term_id' => 'Provider Term ID',
            'clause_title' => 'Clause Title',
            'clause_text' => 'Clause Text',
            'clause_time' => 'Clause Time',
        ];
    }
}
