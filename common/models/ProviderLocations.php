<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_locations".
 *
 * @property integer $id
 * @property string $provider_id
 * @property string $loc_id
 * @property string $name
 * @property string $description
 *
 * @property Provider $provider
 * @property Locations $loc
 */
class ProviderLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'loc_id', 'name'], 'required'],
            [['provider_id', 'loc_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_id' => 'Pružalac usluge.',
            'loc_id' => 'Lokacija.',
            'name' => 'Ime lokacije.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderLocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderLocationsQuery(get_called_class());
    }
}
