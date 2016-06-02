<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_properties".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $property_id
 * @property integer $multiple_values
 * @property integer $translatable_values
 * @property string $class
 * @property string $description
 *
 * @property CsPropertyValues[] $csPropertyValues
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
            [['type', 'property_id', 'multiple_values', 'translatable_values'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['class', 'description'], 'string', 'max' => 32],
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
           'property_id' => Yii::t('app', 'Property ID'),
           'multiple_values' => Yii::t('app', 'Multiple Values'),
           'translatable_values' => Yii::t('app', 'Translatable Values'),
           'class' => Yii::t('app', 'Class'),
           'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValues()
    {
        return $this->hasMany(CsPropertyValues::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(CsProperties::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectProperties()
    {
        return $this->hasMany(CsObjectProperties::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionProperties()
    {
        return $this->hasMany(CsActionProperties::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustryProperties()
    {
        return $this->hasMany(CsIndustryProperties::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $property_translation = \frontend\models\CsPropertiesTranslation::find()->where('lang_code="SR" and property_id='.$this->id)->one();
        if($property_translation) {
            return $property_translation;
        }
        return false;        
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
    public function getTName()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name;
        }       
        return false;   
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
