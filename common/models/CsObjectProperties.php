<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_properties".
 *
 * @property string $id
 * @property string $object_id
 * @property string $object_name
 * @property integer $property_id
 * @property string $property_name
 * @property integer $property_unit_id
 * @property integer $property_unit_imperial_id
 * @property string $property_class
 * @property string $property_type
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
class CsObjectProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'property_id'], 'required'],
            [['object_id', 'property_id', 'property_unit_id', 'property_unit_imperial_id', 'input_type', 'value_min', 'value_max', 'display_order', 'multiple_values', 'specific_values', 'read_only', 'required'], 'integer'],
            [['property_class', 'property_type', 'description'], 'string'],
            [['step'], 'number'],
            [['object_name', 'property_name'], 'string', 'max' => 64],
            [['value_default'], 'string', 'max' => 128],
            [['pattern'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_name' => Yii::t('app', 'Object Name'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'property_unit_id' => Yii::t('app', 'Property Unit ID'),
            'property_unit_imperial_id' => Yii::t('app', 'Property Unit Imperial ID'),
            'property_class' => Yii::t('app', 'Property Class'),
            'property_type' => Yii::t('app', 'Property Type'),
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
     * @inheritdoc
     * @return CsObjectPropertiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectPropertiesQuery(get_called_class());
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectPropertyValues()
    {
        return $this->hasMany(CsObjectPropertyValues::className(), ['object_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
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
}