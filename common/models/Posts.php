<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property integer $post_category_id
 * @property string $title
 * @property string $subtitle
 * @property string $body
 * @property integer $status
 * @property integer $published
 * @property string $time
 * @property string $description
 *
 * @property PostComment[] $postComments
 * @property PostTranslation[] $postTranslations
 * @property PostCategory $postCategory
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_category_id', 'title', 'body', 'time'], 'required'],
            [['post_category_id', 'status', 'published'], 'integer'],
            [['body', 'description'], 'string'],
            [['time'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['subtitle'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_category_id' => 'Kategorija posta.',
            'title' => 'Naslov posta.',
            'subtitle' => 'Podnaslov posta.',
            'body' => 'Tekst posta.',
            'status' => 'Status posta. 0 - neaktivan; 1 - aktivan.',
            'published' => 'Prikazivanje posta. 0 - neobjavljen; 1 - objavljen.',
            'time' => 'Datum i vreme posta.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTranslations()
    {
        return $this->hasMany(PostTranslation::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'post_category_id']);
    }

    /**
     * @inheritdoc
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT($lang_code)
    {
        $translation = $this->postTranslations()->where('lang_code="'.$lang_code.'"')->one();
        if($translation){
            return $translation->name;
        } else {
            return false;
        }
    }
}
