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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'promotion_id' => Yii::t('app', 'Promotion ID'),
            'provider_service_id' => Yii::t('app', 'Provider Service ID'),
            'service_id' => Yii::t('app', 'Service ID'),
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
}
