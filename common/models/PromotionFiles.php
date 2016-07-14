<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotion_files".
 *
 * @property integer $id
 * @property string $promotion_id
 * @property string $file_id
 *
 * @property Images $image
 * @property Promotions $promotion
 */
class PromotionFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotion_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_id', 'file_id'], 'required'],
            [['promotion_id', 'file_id'], 'integer'],
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
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotions::className(), ['id' => 'promotion_id']);
    }
}
