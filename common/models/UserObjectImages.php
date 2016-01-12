<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_images".
 *
 * @property integer $id
 * @property string $user_object_id
 * @property string $image_id
 *
 * @property UserObjects $userObject
 * @property Images $image
 */
class UserObjectImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'image_id'], 'required'],
            [['user_object_id', 'image_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_object_id' => 'Korisnikov predmet usluge.',
            'image_id' => 'Slika/dokument.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObject()
    {
        return $this->hasOne(UserObjects::className(), ['id' => 'user_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @inheritdoc
     * @return UserObjectImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserObjectImagesQuery(get_called_class());
    }
}
