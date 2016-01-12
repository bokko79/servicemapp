<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_specs".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property string $spec_id
 * @property string $value
 * @property string $value_max
 *
 * @property OrderServices $orderService
 * @property CsSpecs $spec
 */
class OrderServiceSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'spec_id', 'value'], 'required'],
            [['order_service_id', 'spec_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 100]
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
            'spec_id' => 'Atribut predmeta usluge.',
            'value' => 'Vrednost atributa predmeta usluge. / Minimalna vrednost u slučaju Rental predmeta usluge.',
            'value_max' => 'Maksimalna vrednost atributa predmeta usluge.',
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
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }

    /**
     * @inheritdoc
     * @return OrderServiceSpecsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderServiceSpecsQuery(get_called_class());
    }
}
