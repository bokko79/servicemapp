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
            'id' => Yii::t('app', 'ID'),
            'user_object_id' => Yii::t('app', 'User Object ID'),
            'image_id' => Yii::t('app', 'Image ID'),
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
}
