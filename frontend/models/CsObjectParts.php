<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_parts".
 *
 * @property string $id
 * @property string $object_id
 * @property string $part_id
 * @property string $object_property_id
 * @property string $class
 * @property string $type
 * @property string $standard
 * @property integer $countable
 * @property integer $item_count
 * @property string $description
 */
class CsObjectParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'part_id', 'object_property_id'], 'required'],
            [['object_id', 'part_id', 'object_property_id', 'countable', 'item_count'], 'integer'],
            [['class', 'type', 'standard', 'description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'part_id' => Yii::t('app', 'Part ID'),
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'class' => Yii::t('app', 'Class'),
            'type' => Yii::t('app', 'Type'),
            'standard' => Yii::t('app', 'Standard'),
            'countable' => Yii::t('app', 'Countable'),
            'item_count' => Yii::t('app', 'Item Count'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPart()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectProperty()
    {
        return $this->hasMany(CsObjectProperties::className(), ['object_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsObjectPartsTranslation::className(), ['object_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $object_translation = \frontend\models\CsObjectPartsTranslation::find()->where('lang_code="SR" and object_part_id='.$this->id)->one();
        if($object_translation) {
            return $object_translation;
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
    public function getPartDescription()
    {
        return c($this->part->tName) . yii\helpers\Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'width:100%; height:110px; margin: 5px 0 10px']); 
    }
}
