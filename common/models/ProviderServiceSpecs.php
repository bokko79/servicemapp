<?php

namespace common\models;

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
            'id' => 'ID',
            'provider_service_id' => 'Usluga pružaoca usluge.',
            'spec_id' => 'Atribut predmeta usluge.',
            'value' => 'Vrednost atributa predmeta usluge. / Minimalna vrednost atributa predmeta usluge.',
            'max' => 'Maksimalna vrednost atributa predmeta usluge.',
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

    /**
     * @inheritdoc
     * @return ProviderServiceSpecsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServiceSpecsQuery(get_called_class());
    }
}
