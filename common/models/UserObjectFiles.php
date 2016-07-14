<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_files".
 *
 * @property integer $id
 * @property string $user_object_id
 * @property string $file_id
 *
 * @property UserObjects $userObject
 * @property Images $image
 */
class UserObjectFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'file_id'], 'required'],
            [['user_object_id', 'file_id'], 'integer']
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
            'file_id' => Yii::t('app', 'File ID'),
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
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
