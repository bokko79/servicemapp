<?php

namespace common\models;

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
            [['type', 'media', 'status'], 'string'],
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
            'id' => 'ID',
            'provider_id' => 'Pružalac usluge.',
            'type' => 'Vrsta banera.',
            'media' => 'Vrsta media.',
            'image_id' => 'Slika/dokument.',
            'industry_id' => 'Uslužna delatnost.',
            'alt_image' => 'Tekst banera.',
            'priority' => 'Prioritet pojavljivanja banera.',
            'status' => 'Status banera. active - aktivan; scheduled - na redu da postane aktivan; expired - istekao; suspended - ukinut; draft - u izradi; deleted - obrisan.',
            'validity' => 'Datum i vreme do kada je baner aktivan. Posle toga prelazi u status \"expired\" - istekao.',
            'time' => 'Datum i vreme unosa banera.',
            'update_time' => 'Datum i vreme izmene banera.',
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
