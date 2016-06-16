<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_object_property_values".
 *
 * @property string $id
 * @property string $presentation_object_property_id
 * @property integer $property_value_id
 * @property string $description
 */
class PresentationObjectPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_object_property_id', 'property_value_id'], 'required'],
            [['presentation_object_property_id', 'property_value_id'], 'integer'],
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
            'presentation_object_property_id' => Yii::t('app', 'Presentation Spec ID'),
            'property_value_id' => Yii::t('app', 'Spec Model'),
            'description' => Yii::t('app', 'Description'),
        ];
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
    public function getPresentationObjectProperty()
    {
        return $this->hasOne(PresentationObjectProperties::className(), ['id' => 'presentation_object_property_id']);
    }    
}
