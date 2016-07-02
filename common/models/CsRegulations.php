<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_regulations".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CsRegulationsTranslation[] $csRegulationsTranslations
 * @property CsServiceRegulations[] $csServiceRegulations
 */
class CsRegulations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_regulations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Zakonska regulativa.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsRegulationsTranslation::className(), ['regulation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['regulation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $regulation_translation = CsRegulationsTranslation::find()->where('lang_code="SR" and regulation_id='.$this->id)->one();
        if($regulation_translation) {
            return $regulation_translation;
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
    public function getBody()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->body;
        }       
        return false;   
    }
}
