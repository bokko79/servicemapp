<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_images".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $image_id
 * @property string $image_type
 * @property string $opis
 *
 * @property Images $image
 * @property User $user
 */
class UserImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'image_id'], 'required'],
            [['user_id', 'image_id'], 'integer'],
            [['image_type', 'opis'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'image_id' => 'Image ID',
            'image_type' => 'Image Type',
            'opis' => 'Opis',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
