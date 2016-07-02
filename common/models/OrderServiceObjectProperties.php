<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_property".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property string $object_property_id
 * @property string $value
 * @property string $value_max
 *
 * @property OrderServices $orderService
 * @property CsObjectProperties $spec
 */
class OrderServiceObjectProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'object_property_id'], 'required'],
            [['order_service_id', 'object_property_id'], 'integer'],
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
            'object_property_id' => Yii::t('app', 'Spec ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Value Max'),
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
    public function getObjectProperty()
    {
        return $this->hasOne(CsObjectProperties::className(), ['id' => 'object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceObjectPropertyValues()
    {
        return $this->hasMany(OrderServiceObjectPropertyValues::className(), ['order_service_object_property_id' => 'id']);
    }
}
