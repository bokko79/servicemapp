<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_part_properties".
 *
 * @property string $id
 * @property string $user_object_part_id
 * @property string $object_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 * @property integer $multiple_values
 * @property integer $read_only
 */
class UserObjectPartProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_part_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_part_id', 'object_property_id'], 'required'],
            [['user_object_part_id', 'object_property_id', 'multiple_values', 'read_only'], 'integer'],
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
            'user_object_part_id' => Yii::t('app', 'User Object Part ID'),
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Value Max'),
            'value_operator' => Yii::t('app', 'Value Operator'),
            'multiple_values' => Yii::t('app', 'Multiple Values'),
            'read_only' => Yii::t('app', 'Read Only'),
        ];
    }
}
