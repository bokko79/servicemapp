<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_service_methods".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property integer $method_id
 * @property string $value
 *
 * @property OrderServices $orderService
 * @property CsMethods $method
 */
class OrderServiceMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'method_id'], 'required'],
            [['order_service_id', 'method_id'], 'integer'],
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
            'method_id' => Yii::t('app', 'Method ID'),
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
    public function getMethod()
    {
        return $this->hasOne(CsMethods::className(), ['id' => 'method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'value']);
    }
}
