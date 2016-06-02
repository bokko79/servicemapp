<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_product_property_values".
 *
 * @property string $id
 * @property string $product_property_id
 * @property string $property_value_id
 * @property integer $selected_value
 * @property string $description
 */
class CsProductPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_product_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_property_id', 'property_value_id'], 'required'],
            [['product_property_id', 'property_value_id', 'selected_value'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_property_id' => Yii::t('app', 'Product Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProperty()
    {
        return $this->hasOne(CsProductProperties::className(), ['id' => 'product_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }
}
