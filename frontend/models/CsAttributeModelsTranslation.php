<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'attribute_model_id' => Yii::t('app', 'Attribute Model ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
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
    public function getAttributeModel()
    {
        return $this->hasOne(CsAttributeModels::className(), ['id' => 'attribute_model_id']);
    }
}
