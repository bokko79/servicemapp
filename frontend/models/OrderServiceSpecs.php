<?php

namespace frontend\models;

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
            [['order_service_id', 'spec_id'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'order_service_id' => Yii::t('app', 'Order Service ID'),
            'spec_id' => Yii::t('app', 'Spec ID'),
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
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(OrderServiceSpecModels::className(), ['order_service_spec_id' => 'id']);
    }
}
