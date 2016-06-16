<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_property_models_translation".
 *
 * @property string $id
 * @property integer $property_value_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_akk 
 * @property string $hint
 * @property string $orig_name
 *
 * @property CsLanguages $langCode
 * @property CsPropertyModels $propertyModel
 */
class CsPropertyValuesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_values_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_value_id', 'lang_code', 'name', 'name_akk'], 'required'],
            [['property_value_id'], 'integer'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'orig_name'], 'string', 'max' => 128],
            [['name_akk'], 'string', 'max' => 100],
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
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_akk' => Yii::t('app', 'Name Akk'), 
            'hint' => Yii::t('app', 'Hint'),
            'orig_name' => Yii::t('app', 'Orig Name'),
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
    public function getPropertyValue()
    {
        return $this->hasOne(CsPropertyValue::className(), ['id' => 'property_value_id']);
    }
}
