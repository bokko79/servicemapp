<?php

namespace frontend\models;

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
 * @property Presentations[] $presentations
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
            [['ozn_htmlfree', 'ozn_htmlfree_imp'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'oznaka' => 'Oznaka',
            'oznaka_imp' => 'Oznaka Imp',
            'ozn_htmlfree' => 'Ozn Htmlfree',
            'ozn_htmlfree_imp' => 'Ozn Htmlfree Imp',
            'description' => 'Description',
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
    public function getProperties()
    {
        return $this->hasMany(CsProperties::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CsServices::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsUnitsTranslation::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['duration_unit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $unit_translation = \frontend\models\CsUnitsTranslation::find()->where('lang_code="SR" and unit_id='.$this->id)->one();
        if($unit_translation) {
            return $unit_translation;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTName()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSCaseName()
    {
        return Yii::$app->operator->sentenceCase($this->tName); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameGen()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_gen;
        }       
        return false;   
    }
}
