<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_action_property_values".
 *
 * @property string $id
 * @property string $presentation_method_id
 * @property integer $property_value_id
 * @property string $description
 */
class PresentationActionPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_action_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_action_property_id', 'property_value_id'], 'required'],
            [['presentation_action_property_id', 'property_value_id'], 'integer'],
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
            'presentation_action_property_id' => Yii::t('app', 'Presentation Method ID'),
            'property_value_id' => Yii::t('app', 'Method Model'),
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
    public function getPresentationActionProperty()
    {
        return $this->hasOne(PresentationActionProperties::className(), ['id' => 'presentation_action_property_id']);
    }
}
