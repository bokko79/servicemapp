<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotion_services".
 *
 * @property string $id
 * @property string $promotion_id
 * @property string $provider_service_id
 * @property integer $service_id
 * @property string $description
 *
 * @property CsServices $service
 * @property ProviderServices $providerService
 * @property Promotions $promotion
 */
class PromotionServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotion_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_id', 'provider_service_id', 'service_id'], 'required'],
            [['promotion_id', 'provider_service_id', 'service_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promotion_id' => 'Promocija usluge.',
            'provider_service_id' => 'Provider Service ID',
            'service_id' => 'Usluga.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
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
    public function getPromotion()
    {
        return $this->hasOne(Promotions::className(), ['id' => 'promotion_id']);
    }

    /**
     * @inheritdoc
     * @return PromotionServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromotionServicesQuery(get_called_class());
    }
}
