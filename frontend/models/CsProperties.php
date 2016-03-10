<?php

namespace frontend\models;

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
            [['name', 'type'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'type' => Yii::t('app', 'Type'), 
            'class' => Yii::t('app', 'Class'), 
            'mark' => Yii::t('app', 'Mark'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
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
    public function getFormType()
    {
        switch ($this->type) {
            case 1:
                $part = '_number';
                break;
            case 2:
                $part = '_radio';
                break;
            case 21:
                $part = '_radioButton';
                break;
            case 3:
                $part = '_select';
                break;
            case 4:
                $part = '_multiselect';
                break;
            case 5:
                $part = '_checkbox';
                break;
            case 51:
                $part = '_checkboxButton';
                break;
            case 6:
                $part = '_text';
                break;
            case 7:
                $part = '_textarea';
                break;
            case 8:
                $part = '_color';
                break;
            case 9:
                $part = '_range';
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
    public function getFormTypePresentation()
    {
        switch ($this->type) {
            case 1:
                $part = '_range';
                break;
            case 2:
                $part = '_multiselect';
                break;
            case 21:
                $part = '_checkboxButton';
                break;
            case 3:
                $part = '_multiselect';
                break;
            case 4:
                $part = '_multiselect';
                break;
            case 5:
                $part = '_checkbox';
                break;
            case 51:
                $part = '_checkboxButton';
                break;
            case 6:
                $part = '_text';
                break;
            case 7:
                $part = '_textarea';
                break;
            case 8:
                $part = '_color';
                break;
            case 9:
                $part = '_number';
                break;
            default:
                $part = '_text';
                break;
        }       
        return $part;
    }
}
