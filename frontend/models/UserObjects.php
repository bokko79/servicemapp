<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_objects".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $object_id
 * @property integer $object_type_id
 * @property string $ime
 * @property string $loc_id
 * @property string $note
 * @property integer $is_set
 * @property string $update_time
 *
 * @property UserObjectImages[] $userObjectImages
 * @property UserObjectSpecs[] $userObjectSpecs
 * @property CsObjects $object
 * @property CsObjectTypes $objectType
 * @property Locations $loc
 * @property User $user
 */
class UserObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id', 'object_type_id', 'update_time'], 'required'],
            [['user_id', 'object_id', 'object_type_id', 'loc_id', 'is_set'], 'integer'],
            [['update_time'], 'safe'],
            [['ime', 'note'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'ime' => Yii::t('app', 'Ime'),
            'loc_id' => Yii::t('app', 'Loc ID'),
            'note' => Yii::t('app', 'Note'),
            'is_set' => Yii::t('app', 'Is Set'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectImages()
    {
        return $this->hasMany(UserObjectImages::className(), ['user_object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectSpecs()
    {
        return $this->hasMany(UserObjectSpecs::className(), ['user_object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(CsObjectTypes::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectName()
    {
        return c($this->object->tName);
    }
}
