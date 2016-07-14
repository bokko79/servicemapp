<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_container_properties".
 *
 * @property string $id
 * @property string $order_service_id
 * @property string $object_container_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 * @property integer $multiple_values
 * @property integer $read_only
 */
class OrderServiceObjectContainerProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_container_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'object_container_property_id'], 'required'],
            [['order_service_id', 'object_container_property_id', 'multiple_values', 'read_only'], 'integer'],
            [['value_operator'], 'string'],
            [['value', 'value_max'], 'string', 'max' => 100],
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
            'object_container_property_id' => Yii::t('app', 'Object Container Property ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Value Max'),
            'value_operator' => Yii::t('app', 'Value Operator'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'read_only' => Yii::t('app', 'Read Only'),
        ];
    }
}
