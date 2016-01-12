<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_methods".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property integer $method_id
 * @property string $value
 * @property string $value_max
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
            [['value', 'value_max'], 'string', 'max' => 120]
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
            'method_id' => 'Opcija usluge.',
            'value' => 'Vrednost opcije usluge. / Minimalna vrednost usluge u slučaju da je predmet usluge Rentals.',
            'value_max' => 'Maksimalna vrednost opcije usluge.',
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
     * @inheritdoc
     * @return OrderServiceMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderServiceMethodsQuery(get_called_class());
    }
}
