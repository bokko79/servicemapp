<?php

namespace common\models;

use Yii;

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
 * @property string $description
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
            [['property_id', 'selected_value', 'image_id'], 'integer'],
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
    public function getTranslation()
    {
        $property_translation = \frontend\models\CsPropertyValuesTranslation::find()->where('lang_code="SR" and property_value_id='.$this->id)->one();
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
        return $this->hasMany(CsPropertyValuesTranslation::className(), ['property_value_id' => 'id']);
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
     * @return CsPropertyValuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsPropertyValuesQuery(get_called_class());
    }
}
