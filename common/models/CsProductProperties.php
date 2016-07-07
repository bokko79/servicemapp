<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_product_properties".
 *
 * @property string $id
 * @property string $product_id
 * @property string $object_property_id
 * @property integer $property_unit_id
 * @property integer $property_unit_imperial_id
 * @property string $property_class
 * @property integer $input_type
 * @property string $value_default
 * @property integer $value_min
 * @property string $value_max
 * @property string $step
 * @property string $pattern
 * @property integer $display_order
 * @property integer $multiple_values
 * @property integer $specific_values
 * @property integer $read_only
 * @property integer $required
 * @property string $description
 */
class CsProductProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_product_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'object_property_id', 'property_name'], 'required'],
            [['product_id', 'object_property_id', 'property_unit_id', 'property_unit_imperial_id', 'input_type', 'value_min', 'value_max', 'display_order', 'multiple_values', 'specific_values', 'read_only', 'required'], 'integer'],
            [['property_class', 'description'], 'string'],
            [['step'], 'number'],
            [['value_default'], 'string', 'max' => 128],
            [['pattern'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'property_unit_id' => Yii::t('app', 'Property Unit ID'),
            'property_unit_imperial_id' => Yii::t('app', 'Property Unit Imperial ID'),
            'property_class' => Yii::t('app', 'Property Class'),
            'input_type' => Yii::t('app', 'Input Type'),
            'value_default' => Yii::t('app', 'Value Default'),
            'value_min' => Yii::t('app', 'Value Min'),
            'value_max' => Yii::t('app', 'Value Max'),
            'step' => Yii::t('app', 'Step'),
            'pattern' => Yii::t('app', 'Pattern'),
            'display_order' => Yii::t('app', 'Display Order'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'specific_values' => Yii::t('app', 'Specific Values'),
            'read_only' => Yii::t('app', 'Read Only'),
            'required' => Yii::t('app', 'Required'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectProperty()
    {
        return $this->hasOne(CsObjectProperties::className(), ['id' => 'object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'property_unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitImperial()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'property_unit_imperial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropertyValues()
    {
        return $this->hasMany(CsProductPropertyValues::className(), ['product_property_id' => 'id']);
    }
}
