<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_types".
 *
 * @property integer $id
 * @property integer $object_class_id
 * @property string $name
 * @property string $description
 *
 * @property CsObjectClasses $objectClass
 * @property CsObjectTypesTranslation[] $csObjectTypesTranslations
 * @property CsObjects[] $csObjects
 * @property UserObjects[] $userObjects
 */
class CsObjectTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_class_id', 'name'], 'required'],
            [['object_class_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_class_id' => Yii::t('app', 'Object Class ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectClass()
    {
        return $this->hasOne(CsObjectClasses::className(), ['id' => 'object_class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsObjectTypesTranslation::className(), ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(CsObjects::className(), ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjects()
    {
        return $this->hasMany(UserObjects::className(), ['object_type_id' => 'id']);
    }
}
