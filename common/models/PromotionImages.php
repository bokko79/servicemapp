<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotion_images".
 *
 * @property integer $id
 * @property string $promotion_id
 * @property string $image_id
 *
 * @property Images $image
 * @property Promotions $promotion
 */
class PromotionImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotion_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_id', 'image_id'], 'required'],
            [['promotion_id', 'image_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'promotion_id' => Yii::t('app', 'Promotion ID'),
            'image_id' => Yii::t('app', 'Image ID'),
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
    public function getPromotion()
    {
        return $this->hasOne(Promotions::className(), ['id' => 'promotion_id']);
    }
}
