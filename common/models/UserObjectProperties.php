<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_properties".
 *
 * @property string $id
 * @property string $user_object_id
 * @property string $object_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 *
 * @property UserObjects $userObject
 */
class UserObjectProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'object_property_id', 'value'], 'required'],
            [['user_object_id', 'object_property_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 64],
            [['value_operator'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_object_id' => Yii::t('app', 'User Object ID'),
            'object_property_id' => Yii::t('app', 'Spec ID'),
            'value' => Yii::t('app', 'Value'),
            'value_max' => Yii::t('app', 'Max'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObject()
    {
        return $this->hasOne(UserObjects::className(), ['id' => 'user_object_id']);
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
    public function getUserObjectPropertyValues()
    {
        return $this->hasMany(UserObjectPropertyValues::className(), ['user_object_property_id' => 'id']);
    }
}
