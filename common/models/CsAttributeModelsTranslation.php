<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_attribute_models_translation".
 *
 * @property string $id
 * @property integer $attribute_model_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 *
 * @property CsLanguages $langCode
 * @property CsAttributeModels $attributeModel
 */
class CsAttributeModelsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_attribute_models_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_model_id', 'lang_code', 'name'], 'required'],
            [['attribute_model_id'], 'integer'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'orig_name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_model_id' => 'Model atributa.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena modela atributa.',
            'orig_name' => 'Originalno ime modela atributa (iz tabele atts_model).',
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
    public function getAttributeModel()
    {
        return $this->hasOne(CsAttributeModels::className(), ['id' => 'attribute_model_id']);
    }

    /**
     * @inheritdoc
     * @return CsAttributeModelsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsAttributeModelsTranslationQuery(get_called_class());
    }
}
