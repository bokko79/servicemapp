<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_service_methods".
 *
 * @property string $id
 * @property string $provider_service_id
 * @property integer $method_id
 * @property string $value
 * @property string $value_max
 *
 * @property ProviderServices $providerService
 * @property CsMethods $method
 */
class ProviderServiceMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_id', 'method_id'], 'required'],
            [['provider_service_id', 'method_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 64]
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
            'method_id' => Yii::t('app', 'Method ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Value Max'),
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
    public function getMethod()
    {
        return $this->hasOne(CsMethods::className(), ['id' => 'method_id']);
    }
}
