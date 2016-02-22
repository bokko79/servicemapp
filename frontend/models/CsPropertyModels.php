<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_property_models".
 *
 * @property integer $id
 * @property string $name
 * @property integer $property_id
 * @property string $property_name
 * @property integer $selected_value 
 * @property string $hint 
 * @property string $image_id
 * @property string $entry_by
 * @property string $entry_time
 * @property string $description
 *
 * @property CsProperties $property
 * @property User $entryBy
 * @property CsPropertyModelsTranslation[] $csPropertyModelsTranslations
 */
class CsPropertyModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'property_id'], 'required'],
            [['property_id', 'selected_value', 'image_id', 'entry_by'], 'integer'],
            [['entry_time'], 'safe'],
            [['description'], 'string'],
            [['name', 'property_name'], 'string', 'max' => 128],
            [['hint'], 'string', 'max' => 256],
            [['entry_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['entry_by' => 'id']],
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
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property'),
            'selected_value' => Yii::t('app', 'Selected Value'), 
            'hint' => Yii::t('app', 'Hint'), 
            'image_id' => Yii::t('app', 'Image ID'), 
            'entry_by' => Yii::t('app', 'Entry By'),
            'entry_time' => Yii::t('app', 'Entry Time'),
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
    public function getOrderSpecModels()
    {
        return $this->hasOne(OrderServiceSpecModels::className(), ['id' => 'spec_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryBy()
    {
        return $this->hasOne(User::className(), ['id' => 'entry_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsPropertyModelsTranslation::className(), ['property_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $property_model_translation = \frontend\models\CsPropertyModelsTranslation::find()->where('lang_code="SR" and property_model_id='.$this->id)->one();
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
}
