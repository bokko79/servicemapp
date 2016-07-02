<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_industry_property_values".
 *
 * @property string $id
 * @property string $order_industry_property_id
 * @property string $property_values_id
 */
class OrderIndustryPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_industry_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_industry_property_id', 'property_values_id'], 'required'],
            [['id', 'order_industry_property_id', 'property_values_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_industry_property_id' => Yii::t('app', 'Order Skill ID'),
            'property_values_id' => Yii::t('app', 'Skill Model'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIndustryProperty()
    {
        return $this->hasOne(OrderIndusrtryProperties::className(), ['id' => 'order_industry_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_values_id']);
    }
}
