<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_service_specs".
 *
 * @property string $id
 * @property string $provider_service_id
 * @property string $spec_id
 * @property string $value
 * @property string $max
 *
 * @property ProviderServices $providerService
 * @property CsSpecs $spec
 */
class ProviderServiceSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_id', 'spec_id'], 'required'],
            [['provider_service_id', 'spec_id'], 'integer'],
            [['value', 'max'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_service_id' => Yii::t('app', 'Provider Service ID'),
            'spec_id' => Yii::t('app', 'Spec ID'),
            'value' => Yii::t('app', 'Value'),
            'max' => Yii::t('app', 'Max'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderService()
    {
        return $this->hasOne(ProviderServices::className(), ['id' => 'provider_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }
}
