<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $post_id
 * @property string $text
 * @property string $status
 * @property string $time
 *
 * @property Posts $post
 * @property User $user
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'text', 'time'], 'required'],
            [['user_id', 'post_id'], 'integer'],
            [['text', 'status'], 'string'],
            [['time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
