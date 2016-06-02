<?php

namespace frontend\models;

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
 * @property string $description
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
            [['description'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_akk' => Yii::t('app', 'Name Akk'),
            'hint' => Yii::t('app', 'Hint'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
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
