<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_services_translation".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $note
 * @property string $subnote
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsServices $service
 */
class CsServicesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_services_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'lang_code', 'name'], 'required'],
            [['service_id'], 'integer'],
            [['note', 'subnote', 'description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Usluga.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena usluge.',
            'orig_name' => 'Originalno ime usluge (iz tabele services).',
            'note' => 'Napomena vezana za uslugu na jeziku.',
            'subnote' => 'Podnapomena vezana za uslugu na jeziku.',
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
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * @inheritdoc
     * @return CsServicesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServicesTranslationQuery(get_called_class());
    }
}
