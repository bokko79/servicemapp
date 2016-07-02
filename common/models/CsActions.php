<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_actions".
 *
 * @property integer $id
 * @property string $name
 * @property integer $object_mode
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 *
 * @property User $addedBy
 * @property CsActionsTranslation[] $csActionsTranslations
 * @property CsMethods[] $csMethods
 * @property CsServices[] $csServices
 */
class CsActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['object_mode', 'added_by'], 'integer'],
            [['status'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Akcija usluge.',
            'object_mode' => 'Parametar koji označava da li akcija sadrži više usluga. 0 - Akcija ima samo jednu  uslugu; 1 - Akcija ima više od jedne usluge.',
            'status' => 'Status aktivnosti.',
            'added_by' => 'Korisnik koji je uneo aktivnost.',
            'added_time' => 'Vreme unošenja aktivnosti.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsActionsTranslation::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionProperties()
    {
        return $this->hasMany(CsActionProperties::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CsServices::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustries()
    {
        // uraditi da lista sve delatnosti u kojima se pojavljuje akcija
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $action_translation = CsActionsTranslation::find()->where('lang_code="SR" and action_id='.$this->id)->one();
        if($action_translation) {
            return $action_translation;
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
    public function getTNameGen()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_gen;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameDat()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_dat;
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
    public function getTNameInst()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_inst;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTGender()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_gender;
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
}
