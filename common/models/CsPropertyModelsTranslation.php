<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_property_models_translation".
 *
 * @property string $id
 * @property integer $property_model_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_akk 
 * @property string $hint
 * @property string $orig_name
 *
 * @property CsLanguages $langCode
 * @property CsPropertyModels $propertyModel
 */
class CsPropertyModelsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_models_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_model_id', 'lang_code', 'name', 'name_akk'], 'required'],
            [['property_model_id'], 'integer'],
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
            'id' => 'ID',
            'property_model_id' => 'Model svojstva.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena modela svojstva.',
            'name_akk' => Yii::t('app', 'Name Akk'), 
            'hint' => Yii::t('app', 'Hint'),
            'orig_name' => 'Originalno ime modela svojstva (iz tabele property_model).',
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
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'property_model_id']);
    }

    /**
     * @inheritdoc
     * @return CsPropertyModelsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsPropertyModelsTranslationQuery(get_called_class());
    }
}
