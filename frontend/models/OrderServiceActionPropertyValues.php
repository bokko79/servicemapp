<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_service_action_property_values".
 *
 * @property string $id
 * @property string $order_service_action_property_id
 * @property string $property_value_id
 * @property string $description
 */
class OrderServiceActionPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_action_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_service_action_property_id', 'property_value_id'], 'required'],
            [['id', 'order_service_action_property_id', 'property_value_id'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_action_property_id' => Yii::t('app', 'Order Service Method ID'),
            'property_value_id' => Yii::t('app', 'Method Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceActionProperty()
    {
        return $this->hasOne(OrderServiceActionProperties::className(), ['id' => 'order_service_action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }
}
