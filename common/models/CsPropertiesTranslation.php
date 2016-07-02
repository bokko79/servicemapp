<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_properties_translation".
 *
 * @property integer $id
 * @property integer $property_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_akk 
 * @property string $hint
 * @property string $orig_name
 *
 * @property CsProperties $property
 * @property CsLanguages $langCode
 */
class CsPropertiesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_properties_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'lang_code', 'name', 'name_akk'], 'required'],
            [['property_id'], 'integer'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['name_akk', 'orig_name'], 'string', 'max' => 64],
            [['hint'], 'string', 'max' => 256],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => CsLanguages::className(), 'targetAttribute' => ['lang_code' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_id' => 'Svojstvo.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena svojstva.',
            'name_akk' => Yii::t('app', 'Name Akk'), 
            'hint' => Yii::t('app', 'Hint'),
            'orig_name' => 'Originalno ime svojstva (iz tabele cs_properties).',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }
}
