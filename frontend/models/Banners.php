<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $type
 * @property string $media
 * @property string $image_id
 * @property integer $industry_id
 * @property string $alt_image
 * @property integer $priority
 * @property string $status
 * @property string $validity
 * @property string $time
 * @property string $update_time
 * @property string $description
 *
 * @property BannerMedia[] $bannerMedia
 * @property Provider $provider
 * @property Images $image
 * @property CsIndustries $industry
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'type', 'media', 'industry_id', 'priority', 'status', 'time'], 'required'],
            [['provider_id', 'image_id', 'industry_id', 'priority'], 'integer'],
            [['type', 'media', 'status', 'description'], 'string'],
            [['validity', 'time', 'update_time'], 'safe'],
            [['alt_image'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'type' => Yii::t('app', 'Type'),
            'media' => Yii::t('app', 'Media'),
            'image_id' => Yii::t('app', 'Image ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
            'alt_image' => Yii::t('app', 'Alt Image'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'validity' => Yii::t('app', 'Validity'),
            'time' => Yii::t('app', 'Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerMedia()
    {
        return $this->hasMany(BannerMedia::className(), ['banner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
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
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }
}
