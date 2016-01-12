<?php

namespace common\models;

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
            'id' => 'ID',
            'provider_service_id' => 'Usluga pružaoca usluge.',
            'method_id' => 'Opcija usluge.',
            'value' => 'Vrednost opcije usluge.',
            'value_max' => 'Maksimalna vrednost.',
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

    /**
     * @inheritdoc
     * @return ProviderServiceMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServiceMethodsQuery(get_called_class());
    }
}
