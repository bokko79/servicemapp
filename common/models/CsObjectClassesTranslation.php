<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_classes_translation".
 *
 * @property integer $id
 * @property integer $object_class_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsObjectClasses $objectClass
 */
class CsObjectClassesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_classes_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_class_id', 'lang_code', 'name', 'orig_name'], 'required'],
            [['object_class_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'orig_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_class_id' => 'Klasa predmeta usluge.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena Klase predmeta usluge.',
            'orig_name' => 'Originalno ime Klase predmeta usluge (iz tabele object_classes).',
            'description' => 'Opis stavke',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectClass()
    {
        return $this->hasOne(CsObjectClasses::className(), ['id' => 'object_class_id']);
    }

    /**
     * @inheritdoc
     * @return CsObjectClassesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectClassesTranslationQuery(get_called_class());
    }
}
