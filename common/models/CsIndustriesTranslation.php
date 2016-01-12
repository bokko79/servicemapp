<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_industries_translation".
 *
 * @property integer $id
 * @property integer $industry_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsIndustries $industry
 */
class CsIndustriesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_industries_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_id', 'lang_code', 'name'], 'required'],
            [['industry_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'industry_id' => 'Delatnost.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena delatnosti (iz tabele industry).',
            'orig_name' => 'Originalno ime delatnosti.',
            'description' => 'Opis delatnosti.',
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
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @inheritdoc
     * @return CsIndustriesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsIndustriesTranslationQuery(get_called_class());
    }
}
