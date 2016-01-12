<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $ime
 * @property string $type
 * @property string $opis
 * @property string $base_encode
 * @property string $date
 *
 * @property BannerMedia[] $bannerMedia
 * @property Banners[] $banners
 * @property CsIndustries[] $csIndustries
 * @property CsObjects[] $csObjects
 * @property OrderServiceImages[] $orderServiceImages
 * @property PromotionImages[] $promotionImages
 * @property ProviderPortfolioImages[] $providerPortfolioImages
 * @property ProviderServiceImages[] $providerServiceImages
 * @property UserDetails[] $userDetails
 * @property UserImages[] $userImages
 * @property UserObjectImages[] $userObjectImages
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ime', 'date'], 'required'],
            [['type', 'base_encode'], 'string'],
            [['date'], 'safe'],
            [['ime', 'opis'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ime' => 'Ime slike/dokumenta.',
            'type' => 'Vrsta slike.',
            'opis' => 'Opis slike.',
            'base_encode' => 'Base Encode hash slike.',
            'date' => 'Datum i vreme postavke slike.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerMedia()
    {
        return $this->hasMany(BannerMedia::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustries()
    {
        return $this->hasMany(CsIndustries::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjects()
    {
        return $this->hasMany(CsObjects::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceImages()
    {
        return $this->hasMany(OrderServiceImages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionImages()
    {
        return $this->hasMany(PromotionImages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioImages()
    {
        return $this->hasMany(ProviderPortfolioImages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceImages()
    {
        return $this->hasMany(ProviderServiceImages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasMany(UserDetails::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserImages()
    {
        return $this->hasMany(UserImages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectImages()
    {
        return $this->hasMany(UserObjectImages::className(), ['image_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }
}
