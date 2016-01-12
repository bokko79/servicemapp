<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_sectors_translation".
 *
 * @property integer $id
 * @property integer $sector_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsSectors $sector
 */
class CsSectorsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_sectors_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector_id', 'lang_code', 'name'], 'required'],
            [['sector_id'], 'integer'],
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
            'sector_id' => 'Sektor usluga.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena sektora usluga.',
            'orig_name' => 'Originalno ime sektora usluga (iz tabele sektor_usluga).',
            'description' => 'Opis stavke.',
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
    public function getSector()
    {
        return $this->hasOne(CsSectors::className(), ['id' => 'sector_id']);
    }

    /**
     * @inheritdoc
     * @return CsSectorsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSectorsTranslationQuery(get_called_class());
    }
}
