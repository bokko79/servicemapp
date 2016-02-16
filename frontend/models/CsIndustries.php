<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_industries".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $category_id
 * @property string $image_id
 * @property string $subtitle
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 * @property string $hit_counter
 * @property string $description
 *
 * @property Banners[] $banners
 * @property CsActions[] $csActions
 * @property Images $image
 * @property CsCategories $category
 * @property User $addedBy
 * @property CsIndustriesTranslation[] $csIndustriesTranslations
 * @property CsServices[] $csServices
 * @property CsSimilarIndustries[] $csSimilarIndustries
 * @property CsSimilarIndustries[] $csSimilarIndustries0
 * @property CsSkills[] $csSkills
 * @property Provider[] $providers
 * @property ProviderServices[] $providerServices
 * @property UserServices[] $userServices
 */
class CsIndustries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_industries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'category_id', 'image_id', 'added_by', 'hit_counter'], 'integer'],
            [['subtitle', 'status', 'description'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image_id' => Yii::t('app', 'Image ID'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'status' => Yii::t('app', 'Status'),
            'added_by' => Yii::t('app', 'Added By'),
            'added_time' => Yii::t('app', 'Added Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(CsActions::className(), ['industry_id' => 'id']);
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
    public function getCategory()
    {
        return $this->hasOne(CsCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->category->sector;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcon()
    {
        return $this->sector->icon;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->sector->color;
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
        return $this->hasMany(CsIndustriesTranslation::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CsServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarIndustries()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarIndustries0()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['similar_industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(CsSkills::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviders()
    {
        return $this->hasMany(Provider::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServices()
    {
        return $this->hasMany(UserServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $industry_translation = \frontend\models\CsIndustriesTranslation::find()->where('lang_code="SR" and industry_id='.$this->id)->one();
        if($industry_translation) {
            return $industry_translation;
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
