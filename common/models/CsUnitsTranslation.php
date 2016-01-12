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
            'id' => 'ID',
            'unit_id' => 'Jedinica mere.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena metričke jedinice mere.',
            'name_gen' => 'Ime jedinice mere u genitivu (koga, čega).',
            'name_imp' => 'Prevod imena imperijalne jedinice mere.',
            'oznaka' => 'Prevod oznake metričke jedinice mere.',
            'oznaka_imp' => 'Prevod oznake imperijalne jedinice mere. ',
            'ozn_htmlfree' => 'Prevod HTML oznake metričke jedinice mere.',
            'ozn_htmlfree_imp' => 'Prevod HTML oznake imperijalne jedinice mere.',
            'orig_name' => 'Originalno ime jedinice mere (iz tabele units).',
            'description' => 'Opis stavke.',
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

    /**
     * @inheritdoc
     * @return CsUnitsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsUnitsTranslationQuery(get_called_class());
    }
}
