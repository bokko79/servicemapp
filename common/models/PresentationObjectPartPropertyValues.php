<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_object_part_property_values".
 *
 * @property string $id
 * @property string $presentation_object_part_property_id
 * @property string $property_value_id
 */
class PresentationObjectPartPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_part_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_object_part_property_id', 'property_value_id'], 'required'],
            [['presentation_object_part_property_id', 'property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'presentation_object_part_property_id' => Yii::t('app', 'Presentation Object Part Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
        ];
    }
}
