<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_service_term_clauses".
 *
 * @property string $id
 * @property string $provider_service_term_id
 * @property string $clause_title
 * @property string $clause_text
 * @property string $clause_time
 *
 * @property ProviderServiceTerms $providerServiceTerm
 */
class ProviderServiceTermClauses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_term_clauses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_term_id', 'clause_title', 'clause_text', 'clause_time'], 'required'],
            [['provider_service_term_id'], 'integer'],
            [['clause_text'], 'string'],
            [['clause_time'], 'safe'],
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
            'provider_service_term_id' => Yii::t('app', 'Provider Service Term ID'),
            'clause_title' => Yii::t('app', 'Clause Title'),
            'clause_text' => Yii::t('app', 'Clause Text'),
            'clause_time' => Yii::t('app', 'Clause Time'),
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
