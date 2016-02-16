<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_properties".
 *
 * @property integer $id
 * @property string $name
 * @property integer $unit_id
 * @property integer $type 
 * @property string $class
 * @property string $mark
 * @property string $description
 *
 * @property CsPropertyModels[] $csPropertyModels
 * @property CsUnits $unit
 * @property CsPropertiesTranslation[] $csPropertiesTranslations
 * @property CsMethods[] $csMethods
 * @property CsSkills[] $csSkills
 * @property CsSpecs[] $csSpecs
 */
class CsProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['unit_id', 'type'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['mark'], 'string', 'max' => 10],
            [['class', 'description'], 'string', 'max' => 32],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Svojstvo.',
            'unit_id' => 'Jedinica mere svojstva. Ako je \"0\", svojstvo nema jedinicu mere, već mnoštvo vrednosti, predefinisanih u tabeli cs_property_model.',
            'mark' => 'Oznaka svojstva.',
            'description' => 'Opis svojstva.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsPropertyModels()
    {
        return $this->hasMany(CsPropertyModels::className(), ['property_id' => 'id']);
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
    public function getT()
    {
        return $this->hasMany(CsPropertiesTranslation::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMethods()
    {
        return $this->hasMany(CsMethods::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(CsSkills::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecs()
    {
        return $this->hasMany(CsSpecs::className(), ['property_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsPropertiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsPropertiesQuery(get_called_class());
    }    
}
