<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_types_translation".
 *
 * @property integer $id
 * @property integer $object_type_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsObjectTypes $objectType
 * @property CsLanguages $langCode
 */
class CsObjectTypesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_types_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_type_id', 'lang_code', 'name'], 'required'],
            [['object_type_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_type_id' => 'Vrsta predmeta usluge.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena Vrste predmeta usluge.',
            'orig_name' => 'Originalno ime Vrste predmeta usluge (iz tabele object_types).',
            'description' => 'Opis stavke.',
        ];
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
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @inheritdoc
     * @return CsObjectTypesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectTypesTranslationQuery(get_called_class());
    }
}
