<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_models".
 *
 * @property string $id
 * @property string $order_service_id
 * @property integer $object_id
 */
class OrderServiceObjectModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'object_id'], 'required'],
            [['order_service_id', 'object_id'], 'integer'],
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
            'object_id' => Yii::t('app', 'Object ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderServices::className(), ['id' => 'order_service_id']);
    }
}
