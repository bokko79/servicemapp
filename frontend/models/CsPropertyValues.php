<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_property_models".
 *
 * @property string $id
 * @property integer $property_id
 * @property string $property_name
 * @property string $value
 * @property string $property_value_id
 * @property integer $selected_value
 * @property string $hint
 * @property string $image_id
 * @property string $video_link
 * @property string $description
 *
 * @property CsProperties $property
 * @property User $entryBy
 * @property CsPropertyModelsTranslation[] $csPropertyModelsTranslations
 */
class CsPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'value'], 'required'],
            [['property_id', 'property_value_id', 'selected_value', 'image_id'], 'integer'],
            [['description'], 'string'],
            [['property_name', 'value'], 'string', 'max' => 128],
            [['hint', 'video_link'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'value' => Yii::t('app', 'Value'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
            'hint' => Yii::t('app', 'Hint'),
            'image_id' => Yii::t('app', 'Image ID'),
            'video_link' => Yii::t('app', 'Video Link'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentPropertyValue()
    {
        return $this->hasOne(CsPropertyValues::className(), ['property_value_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildrenPropertyModels()
    {
        return $this->hasMany(CsPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceObjectPropertyValues()
    {
        return $this->hasMany(OrderServiceObjectPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationObjectPropertyValues()
    {
        return $this->hasMany(PresentationObjectPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationActionPropertyValues()
    {
        return $this->hasMany(PresentationActionPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectPropertyValues()
    {
        return $this->hasMany(UserObjectPropertyValues::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderIndustrySkills()
    {
        return $this->hasMany(ProviderIndustrySkills::className(), ['id' => 'property_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsPropertyValuesTranslation::className(), ['property_value_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $property_model_translation = \frontend\models\CsPropertyValuesTranslation::find()->where('lang_code="SR" and property_value_id='.$this->id)->one();
        if($property_model_translation) {
            return $property_model_translation;
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
    public function getTNameWithHint()
    {
        if ($this->hint!=null) {
            return $this->label . '<span data-container="body" data-toggle="popover" data-placement="top" data-content="'.$this->hint.'">
                 <i class="fa fa-question-circle gray-color"></i>
                </span>'; 
        } else {
            return $this->label;
        }               
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameWithMedia()
    {
        $image = yii\helpers\Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'width:100%; height:110px; margin: 5px 0 10px']);
        if ($this->hint!=null) {
            return $this->label . '<span data-container="body" data-toggle="popover" data-placement="top" data-content="'.$this->hint.'">
                 <i class="fa fa-question-circle gray-color"></i>
                </span>' . $image; 
        } else {
            return $this->label . $image;
        } 
    }
}
