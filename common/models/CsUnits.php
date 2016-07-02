<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_units".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $oznaka
 * @property string $ozn_htmlfree
 * @property integer $conversion_unit
 * @property string $conversion_value
 * @property string $measurement
 *
 * @property CsUnits $conversionUnit
 * @property CsUnits[] $csUnits
 * @property CsUnitsTranslation[] $csUnitsTranslations
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
            [['name', 'type', 'oznaka', 'ozn_htmlfree', 'conversion_unit'], 'required'],
            [['conversion_unit'], 'integer'],
            [['conversion_value'], 'number'],
            [['measurement'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 30],
            [['oznaka'], 'string', 'max' => 25],
            [['ozn_htmlfree'], 'string', 'max' => 10],
            [['conversion_unit'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['conversion_unit' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'oznaka' => Yii::t('app', 'Oznaka'),
            'ozn_htmlfree' => Yii::t('app', 'Ozn Htmlfree'),
            'conversion_unit' => Yii::t('app', 'Conversion Unit'),
            'conversion_value' => Yii::t('app', 'Conversion Value'),
            'measurement' => Yii::t('app', 'Measurement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversionUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'conversion_unit']);
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
    public function getServiceUnits()
    {
        return $this->hasMany(CsServiceUnits::className(), ['unit_id' => 'id']);
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
        $unit_translation = CsUnitsTranslation::find()->where('lang_code="SR" and unit_id='.$this->id)->one();
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
