<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "cs_property_values".
 *
 * @property string $id
 * @property integer $property_id
 * @property string $property_name
 * @property string $value
 * @property integer $selected_value
 * @property string $hint
 * @property string $image_id
 * @property string $video_link
 */
class CsPropertyValues extends \yii\db\ActiveRecord
{
    public $imageFile;

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
            [['property_id', 'selected_value', 'image_id'], 'integer'],
            [['property_name', 'value'], 'string', 'max' => 128],
            [['hint', 'video_link'], 'string', 'max' => 256],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
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
            'selected_value' => Yii::t('app', 'Selected Value'),
            'hint' => Yii::t('app', 'Hint'),
            'image_id' => Yii::t('app', 'Image ID'),
            'video_link' => Yii::t('app', 'Video Link'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            if($this->image and $this->image_id != 2){
                unlink(Yii::getAlias('images/property-values/thumbs/'.$this->image->ime));
                unlink(Yii::getAlias('images/property-values/'.$this->image->ime));
            }
           
            $fileName = $this->id . '_' . $this->name;
            $this->imageFile->saveAs('images/property-values/' . $fileName . '1.' . $this->imageFile->extension);         
            
            $image = new \common\models\Images();
            $image->ime = $fileName . '.' . $this->imageFile->extension;
            $image->type = 'image';
            $image->date = date('Y-m-d H:i:s');
            
            $thumb = 'images/property-values/'.$fileName.'1.'.$this->imageFile->extension;
            Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('images/property-values/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]);                
            Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('images/property-values/thumbs/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]); 
            
            $image->save();

            if($image->save()){
                $this->image_id = $image->id;
                $this->imageFile = null;
                $this->save();
            }

            unlink(Yii::getAlias($thumb));
            
            return;
        } else {

            return false;
        }
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
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
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
    public function getProviderIndustryProperties()
    {
        return $this->hasMany(ProviderIndustryProperties::className(), ['id' => 'property_value_id']);
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
        $property_model_translation = CsPropertyValuesTranslation::find()->where('lang_code="SR" and property_value_id='.$this->id)->one();
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
    public function getHint()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->hint;
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
