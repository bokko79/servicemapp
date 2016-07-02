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
    public $name_akk;
    public $hint;

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
            [['name', 'name_akk'], 'string', 'max' => 64],
            [['class', 'description'], 'string', 'max' => 32],
            [['hint'], 'string', 'max' => 256],
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
        $property_translation = \common\models\CsPropertiesTranslation::find()->where('lang_code="SR" and property_id='.$this->id)->one();
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
     * @return \yii\db\ActiveQuery
     */
    public function getSCaseName()
    {
        return Yii::$app->operator->sentenceCase($this->tName); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabel()
    {
        if($this->getTranslation()) {
            return Yii::$app->operator->sentenceCase($this->getTranslation()->name);
        }       
        return false;   
    }  

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameAkk()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_akk;
        }       
        return false;   
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHint()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->hint;
        }       
        return false;   
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function formType($object_ownership='provider')
    {
        switch ($this->type) {
            case 1:
                $part = ($object_ownership=='user') ? '_number' : '_range';
                break;
            case 2:
                $part = ($object_ownership=='user') ? '_radio' : '_multiselect';
                break;
            case 21:
                $part = ($object_ownership=='user') ? '_radioButton' : '_checkboxButton';
                break;
            case 22:
                $part = '_radio';
            case 23:
                $part = '_radioButton';
                break;
            case 3:
                $part = ($object_ownership=='user') ? '_select' : '_multiselect';
                break;
            case 31:
                $part = ($object_ownership=='user') ? '_select2' : '_multiselect_select2';
                break;
            case 32:
                $part = ($object_ownership=='user') ? '_select_media' : '_multiselect_media';
                break;
            case 4:
                $part = '_multiselect';
                break;            
            case 41:
                $part = '_checkboxButton';
                break;
            case 42:
                $part = '_multiselect_select';
                break;
            case 43:
                $part = '_multiselect_select2';
                break;
            case 44:
                $part = '_multiselect_media';
                break;
            case 5:
                $part = '_checkbox';
                break;
            case 6:
                $part = ($object_ownership=='user') ? '_text' : null;
                break;
            case 7:
                $part = ($object_ownership=='user') ? '_textarea' : null;
                break;
            case 8:
                $part = '_slider';
                break;
            case 9:
                $part = '_range'; // with operator
                break;
            case 10:
                $part = '_date';
                break;
            case 11:
                $part = '_time';
                break;
            case 12:
                $part = '_datetime';
                break;
            case 13:
                $part = '_email';
                break;
            case 14:
                $part = '_url';
                break;
            case 15:
                $part = '_color';
                break;
            case 16:
                $part = '_date_range';
                break;
            default:
                $part = '_text';
                break;
        }       
        return $part;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function formTypePresentation($object_ownership='provider')
    {
        switch ($this->type) {
            case 1:
                $part = '_number';
                break;
            case 2:
                $part = ($object_ownership=='provider') ? '_radio' : '_multiselect';
                break;
            case 21:
                $part = ($object_ownership=='provider') ? '_radioButton' : '_checkboxButton';
                break;
            case 22:
                $part = '_radio';
            case 23:
                $part = '_radioButton';
                break;
            case 3:
                $part = ($object_ownership=='provider') ? '_select' : '_multiselect';
                break;
            case 31:
                $part = ($object_ownership=='provider') ? '_select2' : '_multiselect';
                break;
            case 32:
                $part = ($object_ownership=='provider') ? '_select_media' : '_multiselect';
                break;
            case 4:
                $part = '_multiselect';
                break;            
            case 41:
                $part = '_checkboxButton';
                break;
            case 42:
                $part = '_multiselect_select';
                break;
            case 43:
                $part = '_multiselect_select2';
                break;
            case 44:
                $part = '_multiselect_media';
                break;
            case 5:
                $part = '_checkbox';
                break;            
            case 6:
                $part = ($object_ownership=='provider') ? '_text' : null;
                break;
            case 7:
                $part = ($object_ownership=='provider') ? '_textarea' : null;
                break;
            case 8:
                $part = '_slider';
                break;
            case 9:
                $part = '_range';
                break;
            case 10:
                $part = '_date';
                break;
            case 11:
                $part = '_time';
                break;
            case 12:
                $part = '_datetime';
                break;
            case 13:
                $part = '_email';
                break;
            case 14:
                $part = '_url';
                break;
            case 15:
                $part = '_color';
                break;
            case 16:
                $part = '_date_range';
                break;
            default:
                $part = '_text';
                break;
        }       
        return $part;
    } 
}
