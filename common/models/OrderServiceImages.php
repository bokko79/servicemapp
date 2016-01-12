<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_images".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property string $image_id
 *
 * @property Images $image
 * @property OrderServices $orderService
 */
class OrderServiceImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'image_id'], 'required'],
            [['order_service_id', 'image_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_service_id' => 'Usluga zahteva.',
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
    public function getOrderService()
    {
        return $this->hasOne(OrderServices::className(), ['id' => 'order_service_id']);
    }

    /**
     * @inheritdoc
     * @return OrderServiceImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderServiceImagesQuery(get_called_class());
    }
}
