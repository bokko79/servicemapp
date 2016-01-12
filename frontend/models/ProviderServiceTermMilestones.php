<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_service_term_milestones".
 *
 * @property string $id
 * @property string $provider_service_term_id
 * @property string $name
 * @property integer $percentage
 * @property string $amount
 * @property string $date
 *
 * @property ProviderServiceTerms $providerServiceTerm
 */
class ProviderServiceTermMilestones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_term_milestones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_term_id', 'name'], 'required'],
            [['provider_service_term_id', 'percentage'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'provider_service_term_id' => Yii::t('app', 'Provider Service Term ID'),
            'name' => Yii::t('app', 'Name'),
            'percentage' => Yii::t('app', 'Percentage'),
            'amount' => Yii::t('app', 'Amount'),
            'date' => Yii::t('app', 'Date'),
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
