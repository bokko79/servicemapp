<?php

namespace common\models;

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
            'id' => 'ID',
            'code' => 'Jedinstvena šifra delatnosti.',
            'name' => 'Ime delatnosti.',
            'category_id' => 'Kategorija uslužne delatnosti.',
            'image_id' => 'Slika delatnosti.',
            'subtitle' => 'Podnaslov delatnosti.',
            'status' => 'Status',
            'added_by' => 'Added By',
            'added_time' => 'Added Time',
            'hit_counter' => 'Broj poseta delatnosti.',
            'description' => 'Opis delatnosti.',
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
    public function getCsActions()
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
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustriesTranslations()
    {
        return $this->hasMany(CsIndustriesTranslation::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServices()
    {
        return $this->hasMany(CsServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarIndustries()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarIndustries0()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['similar_industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSkills()
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
     * @inheritdoc
     * @return CsIndustriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsIndustriesQuery(get_called_class());
    }
}
