<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_objects".
 *
 * @property integer $id
 * @property string $name
 * @property integer $object_type_id
 * @property integer $favour
 * @property string $image_id
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 * @property string $description
 *
 * @property CsObjectIssues[] $csObjectIssues
 * @property CsObjectTypes $objectType
 * @property Images $image
 * @property User $addedBy
 * @property CsObjectsTranslation[] $csObjectsTranslations
 * @property CsServices[] $csServices
 * @property CsSpecs[] $csSpecs
 * @property UserObjects[] $userObjects
 */
class CsObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['object_type_id', 'favour', 'image_id', 'added_by'], 'integer'],
            [['status', 'description'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime predmeta usluge',
            'object_type_id' => 'Vrsta predmeta usluga kojoj ovaj predmet usluge pripada',
            'favour' => 'Mogućnost snimanja predmeta usluge kao \"favourite\" od strane korisnika. 0 - ne može; 1 - može.',
            'image_id' => 'Slika predmeta usluge.',
            'status' => 'Status predmeta usluge.',
            'added_by' => 'Korisnik koji je uneo predmet usluge.',
            'added_time' => 'Vreme unošenja predmeta usluge.',
            'description' => 'Opis predmeta usluge.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectIssues()
    {
        return $this->hasMany(CsObjectIssues::className(), ['object_id' => 'id']);
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
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectsTranslations()
    {
        return $this->hasMany(CsObjectsTranslation::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServices()
    {
        return $this->hasMany(CsServices::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSpecs()
    {
        return $this->hasMany(CsSpecs::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjects()
    {
        return $this->hasMany(UserObjects::className(), ['object_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectsQuery(get_called_class());
    }
}
