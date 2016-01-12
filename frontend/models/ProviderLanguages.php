<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'opis' => Yii::t('app', 'Opis'),
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
}
