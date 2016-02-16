<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_specs".
 *
  * @property string $id
 * @property integer $object_id
 * @property string $object_name
 * @property integer $property_id
 * @property string $property_name
 * @property string $default_value 
 * @property integer $range_min
 * @property string $range_max
 * @property integer $range_step
 * @property string $required
 * @property string $description
 *
 * @property CsServiceSpecs[] $csServiceSpecs
 * @property CsObjects $object
 * @property CsProperties $property
 * @property OrderServiceSpecs[] $orderServiceSpecs
 * @property PresentationSpecs[] $presentationSpecs
 */
class CsSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'property_id'], 'required'],
            [['object_id', 'property_id', 'range_min', 'range_max', 'range_step', 'required'], 'integer'],
            [['description'], 'string'],
            [['object_name', 'property_name'], 'string', 'max' => 64],
            [['default_value'], 'string', 'max' => 16],
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
            'object_name' => Yii::t('app', 'Object'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property'),
            'default_value' => Yii::t('app', 'Default Value'),
            'range_min' => Yii::t('app', 'Range Min'),
            'range_max' => Yii::t('app', 'Range Max'),
            'range_step' => Yii::t('app', 'Range Step'),
            'required' => Yii::t('app', 'Required'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceSpecs()
    {
        return $this->hasMany(CsServiceSpecs::className(), ['spec_id' => 'id']);
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
    public function getOrderServiceSpecs()
    {
        return $this->hasMany(OrderServiceSpecs::className(), ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationSpecs()
    {
        return $this->hasMany(PresentationSpecs::className(), ['spec_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsSpecsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSpecsQuery(get_called_class());
    }
}
