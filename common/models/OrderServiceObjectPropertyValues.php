<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_property_values".
 *
 * @property string $id
 * @property string $order_service_object_property_id
 * @property integer $property_value_id
 *
 * @property OrderServiceSpecs $orderServiceSpec
 * @property PropertyModel $propertyModel
 */
class OrderServiceObjectPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_spec_id', 'property_value_id'], 'required'],
            [['order_service_spec_id', 'property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_spec_id' => Yii::t('app', 'Order Service Spec ID'),
            'property_value_id' => Yii::t('app', 'Spec Model'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceObjectProperty()
    {
        return $this->hasOne(OrderServiceObjectProperties::className(), ['id' => 'order_service_object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }
}
