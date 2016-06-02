<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_spec_models".
 *
 * @property string $id
 * @property string $object_property_id
 * @property string $property_value_id
 * @property integer $selected_value
 * @property string $description
 */
class CsObjectPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_property_id', 'property_value_id'], 'required'],
            [['object_property_id', 'property_value_id', 'selected_value'], 'integer'],
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
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
            'description' => Yii::t('app', 'Description'),
        ];
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
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceObjectPropertyValues()
    {
        return $this->hasMany(CsServiceObjectPropertyValues::className(), ['object_property_value_id' => 'id']);
    }
}
