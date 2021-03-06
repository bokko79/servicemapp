<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
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
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
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
            'id' => Yii::t('app', 'ID'),
            'ime' => Yii::t('app', 'Ime'),
            'type' => Yii::t('app', 'Type'),
            'opis' => Yii::t('app', 'Opis'),
            'base_encode' => Yii::t('app', 'Base Encode'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerMedia()
    {
        return $this->hasMany(BannerMedia::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustries()
    {
        return $this->hasMany(CsIndustries::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjects()
    {
        return $this->hasMany(CsObjects::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceObjectFiles()
    {
        return $this->hasMany(OrderServiceObjectFiles::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionFiles()
    {
        return $this->hasMany(PromotionImages::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderPortfolioFiles()
    {
        return $this->hasMany(ProviderPortfolioImages::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasMany(UserDetails::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFiles()
    {
        return $this->hasMany(UserFiles::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectFiles()
    {
        return $this->hasMany(UserObjectFiles::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageByName($name=null)
    {
        if($name!=null){
            $image = Files::find()->where('ime="'.$name.'"')->one();
            if($image){
                return $image;
            }
            return null;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageByBaseEncode($base_encode=null)
    {
        if($base_encode!=null){
            $image = Files::find()->where('base_encode="'.$base_encode.'"')->one();
            if($image){
                return $image;
            }
            return null;
        }
        return false;
    }
}
