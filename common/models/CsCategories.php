<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_categories".
 *
 * @property integer $id
 * @property integer $sector_id
 * @property string $name
 *
 * @property CsSectors $sector
 * @property CsCategoriesTranslation[] $csCategoriesTranslations
 * @property CsIndustries[] $csIndustries
 */
class CsCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector_id', 'name'], 'required'],
            [['sector_id'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sector_id' => 'Sektor usluga kojem kategorija uslužnih delatnosti priprada.',
            'name' => 'Ime kategorije uslužnih delatnosti.',            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(CsSectors::className(), ['id' => 'sector_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsCategoriesTranslation::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustries()
    {
        return $this->hasMany(CsIndustries::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $category_translation = \common\models\CsCategoriesTranslation::find()->where('lang_code="SR" and category_id='.$this->id)->one();
        if($category_translation) {
            return $category_translation;
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
