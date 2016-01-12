<?php

namespace common\models;

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
            'id' => 'ID',
            'provider_service_term_id' => 'Uslovi pružnja usluge pružaoca.',
            'name' => 'Ime faze.',
            'percentage' => 'Procenat od ukupne cene usluge koji treba isplatiti na kraju ove faze.',
            'amount' => 'Iznos koji treba uplatiti na kraju ove faze.',
            'date' => 'Vreme kada se faza završava.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTerm()
    {
        return $this->hasOne(ProviderServiceTerms::className(), ['provider_service_id' => 'provider_service_term_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderServiceTermMilestonesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServiceTermMilestonesQuery(get_called_class());
    }
}
