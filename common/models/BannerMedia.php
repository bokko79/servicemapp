<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner_media".
 *
 * @property string $id
 * @property string $banner_id
 * @property string $image_id
 * @property integer $wdth
 * @property integer $hght
 * @property string $type
 *
 * @property Images $image
 * @property Banners $banner
 */
class BannerMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id', 'wdth', 'hght', 'type'], 'required'],
            [['banner_id', 'image_id', 'wdth', 'hght'], 'integer'],
            [['type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_id' => 'Baner.',
            'image_id' => 'Slika/dokument.',
            'wdth' => 'Širina media.',
            'hght' => 'Visina media.',
            'type' => 'Vrsta media.',
        ];
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
    public function getBanner()
    {
        return $this->hasOne(Banners::className(), ['id' => 'banner_id']);
    }
}
