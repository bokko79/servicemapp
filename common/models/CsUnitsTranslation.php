<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_units_translation".
 *
 * @property integer $id
 * @property integer $unit_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $oznaka
 * @property string $ozn_htmlfree
 * @property string $orig_name
 *
 * @property CsUnits $unit
 * @property CsLanguages $langCode
 */
class CsUnitsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_units_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_id', 'lang_code', 'name', 'name_gen'], 'required'],
            [['unit_id'], 'integer'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'oznaka', 'orig_name'], 'string', 'max' => 25],
            [['ozn_htmlfree'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_gen' => Yii::t('app', 'Name Gen'),
            'oznaka' => Yii::t('app', 'Oznaka'),
            'ozn_htmlfree' => Yii::t('app', 'Ozn Htmlfree'),
            'orig_name' => Yii::t('app', 'Orig Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }
}
