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
 * @property string $opis
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
            [['text', 'status', 'opis'], 'string'],
            [['time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'post_id' => 'Post.',
            'text' => 'Tekst komentara na post.',
            'status' => 'Status komentara na post. active - aktivan; banned - ukinut; deleted - obrisan; edited - izmenjen.',
            'time' => 'Datum i vreme komentara na post.',
            'opis' => 'Opis stavke.',
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

    /**
     * @inheritdoc
     * @return PostCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostCommentQuery(get_called_class());
    }
}
