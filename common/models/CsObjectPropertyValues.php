<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_property_values".
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
     * @inheritdoc
     * @return CsObjectPropertyValuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectPropertyValuesQuery(get_called_class());
    }
}
