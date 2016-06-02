<?php

namespace frontend\models;

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
            [['order_service_id', 'image_id'], 'integer'],
            [['type'], 'string'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Images::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['order_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderServices::className(), 'targetAttribute' => ['order_service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_id' => Yii::t('app', 'Order Service ID'),
            'image_id' => Yii::t('app', 'Image ID'),
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
}
