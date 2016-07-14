<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_object_container_properties".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $object_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 * @property integer $multiple_values
 * @property integer $read_only
 */
class PresentationObjectContainerProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_container_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'object_property_id'], 'required'],
            [['presentation_id', 'object_property_id', 'multiple_values', 'read_only'], 'integer'],
            [['value_operator'], 'string'],
            [['value', 'value_max'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Value Max'),
            'value_operator' => Yii::t('app', 'Value Operator'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'read_only' => Yii::t('app', 'Read Only'),
        ];
    }
}
