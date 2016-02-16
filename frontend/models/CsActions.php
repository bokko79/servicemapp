<?php

namespace frontend\models;

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
 * @property string $description
 *
 * @property CsIndustries $industry
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
            [['status', 'description'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'object_mode' => Yii::t('app', 'Object Mode'),
            'status' => Yii::t('app', 'Status'),
            'added_by' => Yii::t('app', 'Added By'),
            'added_time' => Yii::t('app', 'Added Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
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
    public function getMethods()
    {
        return $this->hasMany(CsMethods::className(), ['action_id' => 'id']);
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
        $action_translation = \frontend\models\CsActionsTranslation::find()->where('lang_code="SR" and action_id='.$this->id)->one();
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
    public function getSCaseName()
    {
        return Yii::$app->operator->sentenceCase($this->tName); 
    }
}
