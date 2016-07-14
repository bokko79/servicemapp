<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_quantities".
 *
 * @property string $order_id
 * @property string $amount
 * @property string $amount_to
 * @property string $amount_operator
 * @property integer $consumer
 * @property integer $consumer_to
 * @property string $consumer_operator
 * @property integer $consumer_child
 * @property integer $duration
 * @property string $duration_unit
 * @property string $duration_operator
 */
class OrderQuantities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_quantities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'amount', 'amount_to', 'consumer', 'consumer_to', 'consumer_child', 'duration'], 'integer'],
            [['amount_operator', 'consumer_operator', 'duration_unit', 'duration_operator'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'amount' => Yii::t('app', 'Amount'),
            'amount_to' => Yii::t('app', 'Amount To'),
            'amount_operator' => Yii::t('app', 'Amount Operator'),
            'consumer' => Yii::t('app', 'Consumer'),
            'consumer_to' => Yii::t('app', 'Consumer To'),
            'consumer_operator' => Yii::t('app', 'Consumer Operator'),
            'consumer_child' => Yii::t('app', 'Consumer Child'),
            'duration' => Yii::t('app', 'Duration'),
            'duration_unit' => Yii::t('app', 'Duration Unit'),
            'duration_operator' => Yii::t('app', 'Duration Operator'),
        ];
    }
}
