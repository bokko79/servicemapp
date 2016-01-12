<?php

namespace common\models;

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
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'object_id' => 'Predmet usluge.',
            'object_type_id' => 'Vrsta predmeta usluge.',
            'ime' => 'Ime predmeta usluge.',
            'loc_id' => 'Lokacija predmeta usluge.',
            'note' => 'Opis predmeta usluge.',
            'is_set' => 'Da li je predmet usluge podešen. 0 - ne; 1 - da.',
            'update_time' => 'Vreme podešavanja predmeta usluge.',
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
     * @inheritdoc
     * @return UserObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserObjectsQuery(get_called_class());
    }
}
