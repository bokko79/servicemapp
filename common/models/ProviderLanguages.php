<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_languages".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $lang_code
 * @property string $opis
 *
 * @property Provider $provider
 * @property CsLanguages $langCode
 */
class ProviderLanguages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'lang_code'], 'required'],
            [['provider_id'], 'integer'],
            [['opis'], 'string'],
            [['lang_code'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_id' => 'Pružalac usluge.',
            'lang_code' => 'Jezik.',
            'opis' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
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
     * @return ProviderLanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderLanguagesQuery(get_called_class());
    }
}
