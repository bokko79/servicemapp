<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_object_property_values".
 *
 * @property string $id
 * @property string $user_object_property_id
 * @property integer $property_value_id
 * @property string $description
 */
class UserObjectPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_property_id', 'property_value_id'], 'required'],
            [['user_object_property_id', 'property_value_id'], 'integer'],
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
            'user_object_property_id' => Yii::t('app', 'User Object Spec ID'),
            'property_value_id' => Yii::t('app', 'Spec Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectProperty()
    {
        return $this->hasOne(UserObjectProperties::className(), ['id' => 'user_object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }
}
