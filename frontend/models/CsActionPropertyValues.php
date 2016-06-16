<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_action_property_values".
 *
 * @property string $id
 * @property string $action_property_id
 * @property string $property_value_id
 * @property integer $selected_value
 * @property string $description
 */
class CsActionPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_action_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_property_id', 'property_value_id'], 'required'],
            [['action_property_id', 'property_value_id', 'selected_value'], 'integer'],
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
            'action_property_id' => Yii::t('app', 'Action Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionProperty()
    {
        return $this->hasOne(CsActionProperties::className(), ['id' => 'action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertiesValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceActionPropertyValues()
    {
        return $this->hasMany(CsServiceActionPropertyValues::className(), ['action_property_value_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsActionPropertyValuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsActionPropertyValuesQuery(get_called_class());
    }
}
