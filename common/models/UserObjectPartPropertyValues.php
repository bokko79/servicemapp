<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_part_property_values".
 *
 * @property string $id
 * @property string $user_object_part_property_id
 * @property string $property_value_id
 */
class UserObjectPartPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_part_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_part_property_id', 'property_value_id'], 'required'],
            [['user_object_part_property_id', 'property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_object_part_property_id' => Yii::t('app', 'User Object Part Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
        ];
    }
}
