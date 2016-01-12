<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_units_translation".
 *
 * @property integer $id
 * @property integer $unit_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $name_imp
 * @property string $oznaka
 * @property string $oznaka_imp
 * @property string $ozn_htmlfree
 * @property string $ozn_htmlfree_imp
 * @property string $orig_name
 * @property string $description
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
            [['unit_id', 'lang_code', 'name', 'name_gen', 'name_imp'], 'required'],
            [['unit_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_imp', 'oznaka', 'oznaka_imp', 'orig_name'], 'string', 'max' => 25],
            [['ozn_htmlfree', 'ozn_htmlfree_imp'], 'string', 'max' => 10]
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
            'name_imp' => Yii::t('app', 'Name Imp'),
            'oznaka' => Yii::t('app', 'Oznaka'),
            'oznaka_imp' => Yii::t('app', 'Oznaka Imp'),
            'ozn_htmlfree' => Yii::t('app', 'Ozn Htmlfree'),
            'ozn_htmlfree_imp' => Yii::t('app', 'Ozn Htmlfree Imp'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
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
