<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_times".
 *
 * @property string $order_id
 * @property string $delivery_start
 * @property string $delivery_end
 * @property string $delivery_time_operator
 * @property integer $frequency
 * @property string $frequency_unit
 */
class OrderTimes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_times';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'delivery_start'], 'required'],
            [['order_id', 'frequency'], 'integer'],
            [['delivery_start', 'delivery_end'], 'safe'],
            [['delivery_time_operator', 'frequency_unit'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'delivery_start' => Yii::t('app', 'Delivery Start'),
            'delivery_end' => Yii::t('app', 'Delivery End'),
            'delivery_time_operator' => Yii::t('app', 'Delivery Time Operator'),
            'frequency' => Yii::t('app', 'Frequency'),
            'frequency_unit' => Yii::t('app', 'Frequency Unit'),
        ];
    }
}
