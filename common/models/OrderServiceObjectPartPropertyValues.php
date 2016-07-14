<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_part_property_values".
 *
 * @property string $id
 * @property string $order_service_object_part_property_id
 * @property string $property_value_id
 */
class OrderServiceObjectPartPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_part_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_object_part_property_id', 'property_value_id'], 'required'],
            [['order_service_object_part_property_id', 'property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_object_part_property_id' => Yii::t('app', 'Order Service Object Part Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
        ];
    }
}
