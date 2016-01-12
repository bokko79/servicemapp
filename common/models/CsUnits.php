<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_units".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $oznaka
 * @property string $oznaka_imp
 * @property string $ozn_htmlfree
 * @property string $ozn_htmlfree_imp
 * @property string $description
 *
 * @property Bids[] $bids
 * @property CsAttributes[] $csAttributes
 * @property CsServices[] $csServices
 * @property CsUnitsTranslation[] $csUnitsTranslations
 * @property ProviderServices[] $providerServices
 */
class CsUnits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'oznaka', 'oznaka_imp'], 'required'],
            [['type'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['oznaka', 'oznaka_imp', 'description'], 'string', 'max' => 25],
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
            'type' => 'Vrsta jedinice mere.',
            'name' => 'Ime jedinice mere u formi (metric/imperial).',
            'oznaka' => 'Oznaka metričke jedinice mere.',
            'oznaka_imp' => 'Oznaka imperialne jedinice mere.',
            'ozn_htmlfree' => 'Oznaka metričke HTML jedinice mere.',
            'ozn_htmlfree_imp' => 'Oznaka imperialne HTML jedinice mere.',
            'description' => 'Opis jedinice mere.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['period_unit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributes()
    {
        return $this->hasMany(CsAttributes::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServices()
    {
        return $this->hasMany(CsServices::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsUnitsTranslations()
    {
        return $this->hasMany(CsUnitsTranslation::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['period_unit' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsUnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsUnitsQuery(get_called_class());
    }
}
