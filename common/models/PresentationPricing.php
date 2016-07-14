<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_pricing".
 *
 * @property string $presentation_id
 * @property string $price
 * @property string $price_per
 * @property integer $price_unit
 * @property string $price_operator
 * @property integer $currency_id
 * @property integer $fixed_price
 * @property integer $consumer_price
 * @property integer $qtyPriceConst
 * @property integer $qtyMin
 * @property string $qtyMin_price
 * @property string $qtyMax
 * @property integer $qtyMax_percent
 * @property integer $consumerPriceConst
 * @property integer $consumerMin
 * @property string $consumerMin_price
 * @property string $consumerMax
 * @property integer $consumerMax_percent
 * @property integer $availabilityPriceConst
 * @property integer $availability_percent
 */
class PresentationPricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'price', 'currency_id'], 'required'],
            [['presentation_id', 'price_unit', 'currency_id', 'fixed_price', 'consumer_price', 'qtyPriceConst', 'qtyMin', 'qtyMax', 'qtyMax_percent', 'consumerPriceConst', 'consumerMin', 'consumerMax', 'consumerMax_percent', 'availabilityPriceConst', 'availability_percent'], 'integer'],
            [['price', 'qtyMin_price', 'consumerMin_price'], 'number'],
            [['price_operator'], 'string'],
            [['price_per'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'price' => Yii::t('app', 'Price'),
            'price_per' => Yii::t('app', 'Price Per'),
            'price_unit' => Yii::t('app', 'Price Unit'),
            'price_operator' => Yii::t('app', 'Price Operator'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'fixed_price' => Yii::t('app', 'Fixed Price'),
            'consumer_price' => Yii::t('app', 'Consumer Price'),
            'qtyPriceConst' => Yii::t('app', 'Qty Price Const'),
            'qtyMin' => Yii::t('app', 'Qty Min'),
            'qtyMin_price' => Yii::t('app', 'Qty Min Price'),
            'qtyMax' => Yii::t('app', 'Qty Max'),
            'qtyMax_percent' => Yii::t('app', 'Qty Max Percent'),
            'consumerPriceConst' => Yii::t('app', 'Consumer Price Const'),
            'consumerMin' => Yii::t('app', 'Consumer Min'),
            'consumerMin_price' => Yii::t('app', 'Consumer Min Price'),
            'consumerMax' => Yii::t('app', 'Consumer Max'),
            'consumerMax_percent' => Yii::t('app', 'Consumer Max Percent'),
            'availabilityPriceConst' => Yii::t('app', 'Availability Price Const'),
            'availability_percent' => Yii::t('app', 'Availability Percent'),
        ];
    }
}
