<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_sectors".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $info
 * @property string $color
 * @property string $icon
 *
 * @property CsCategories[] $csCategories
 * @property CsSectorsTranslation[] $csSectorsTranslations
 */
class CsSectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_sectors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description', 'info'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 8],
            [['icon'], 'string', 'max' => 17]
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
            'description' => Yii::t('app', 'Description'),
            'info' => Yii::t('app', 'Info'),
            'color' => Yii::t('app', 'Color'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CsCategories::className(), ['sector_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsSectorsTranslation::className(), ['sector_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $sector_translation = \frontend\models\CsSectorsTranslation::find()->where('lang_code="SR" and sector_id='.$this->id)->one();
        if($sector_translation) {
            return $sector_translation;
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
}
