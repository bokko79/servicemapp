<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_action_properties".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property integer $action_property_id
 * @property string $value
 *
 * @property OrderServices $orderService
 * @property CsActionProperties $actionProperty
 */
class OrderServiceActionProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_action_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'action_property_id'], 'required'],
            [['order_service_id', 'action_property_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 100],
            [['multiple_values', 'read_only'], 'integer'],
            [['value_operator'], 'string'],
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
            'action_property_id' => Yii::t('app', 'Method ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderServices::className(), ['id' => 'order_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionProperty()
    {
        return $this->hasOne(CsActionProperties::className(), ['id' => 'action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'value']);
    }
}
