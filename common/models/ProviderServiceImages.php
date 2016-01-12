<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_service_images".
 *
 * @property string $id
 * @property string $provider_service_id
 * @property string $image_id
 *
 * @property Images $image
 * @property ProviderServices $providerService
 */
class ProviderServiceImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_service_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_service_id', 'image_id'], 'required'],
            [['provider_service_id', 'image_id'], 'integer']
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
            'image_id' => 'Slika/dokument.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderService()
    {
        return $this->hasOne(ProviderServices::className(), ['id' => 'provider_service_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderServiceImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServiceImagesQuery(get_called_class());
    }
}
