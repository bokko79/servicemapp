<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_action_properties".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $action_name
 * @property integer $property_id
 * @property string $property_name
 * @property string $value_default
 * @property integer $value_min
 * @property string $value_max
 * @property string $step
 * @property string $pattern
 * @property integer $display_order
 * @property integer $multiple_values
 * @property integer $read_only
 * @property integer $required
 * @property string $description
 *
 * @property CsActions $action
 * @property CsAttributes $attribute
 * @property OrderServiceActionProperties[] $orderServiceActionProperties
 * @property PresentationActionProperties[] $presentationActionProperties
 */
class CsActionProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_action_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'property_id'], 'required'],
            [['action_id', 'property_id', 'value_min', 'value_max', 'display_order', 'multiple_values', 'read_only', 'required'], 'integer'],
            [['step'], 'number'],
            [['description'], 'string'],
            [['action_name', 'property_name'], 'string', 'max' => 64],
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
            'action_id' => Yii::t('app', 'Action ID'),
            'action_name' => Yii::t('app', 'Action Name'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'value_default' => Yii::t('app', 'Value Default'),
            'value_min' => Yii::t('app', 'Value Min'),
            'value_max' => Yii::t('app', 'Value Max'),
            'step' => Yii::t('app', 'Step'),
            'pattern' => Yii::t('app', 'Pattern'),
            'display_order' => Yii::t('app', 'Display Order'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'read_only' => Yii::t('app', 'Read Only'),
            'required' => Yii::t('app', 'Required'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
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
    public function getActionPropertyValues()
    {
        return $this->hasMany(ActionPropertyValues::className(), ['action_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceActionProperties()
    {
        return $this->hasMany(OrderServiceActionProperties::className(), ['action_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationActionProperties()
    {
        return $this->hasMany(PresentationActionProperties::className(), ['action_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceActionProperties()
    {
        return $this->hasMany(CsServiceActionProperties::className(), ['action_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function serviceActionProperty($service_id)
    {
        return \frontend\models\CsServiceActionProperties::find()->where('action_property_id='.$this->id.' AND service_id='.$service_id)->one();
    }
}
