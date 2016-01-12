<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_attributes_translation".
 *
 * @property integer $id
 * @property integer $attribute_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsAttributes $attribute
 * @property CsLanguages $langCode
 */
class CsAttributesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_attributes_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'lang_code', 'name'], 'required'],
            [['attribute_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Atribut.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena atributa.',
            'orig_name' => 'Originalno ime atributa (iz tabele attributes).',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute()
    {
        return $this->hasOne(CsAttributes::className(), ['id' => 'attribute_id']);
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
     * @return CsAttributesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsAttributesTranslationQuery(get_called_class());
    }
}
