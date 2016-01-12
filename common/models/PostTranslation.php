<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_translation".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $lang_code
 * @property string $title
 * @property string $subtitle
 * @property string $body
 * @property string $orig_title
 * @property string $opis
 *
 * @property CsLanguages $langCode
 * @property Posts $post
 */
class PostTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'lang_code', 'title', 'body', 'orig_title'], 'required'],
            [['post_id'], 'integer'],
            [['body', 'opis'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['title', 'orig_title'], 'string', 'max' => 128],
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
            'post_id' => 'Post.',
            'lang_code' => 'Jezik.',
            'title' => 'Prevod naslova posta.',
            'subtitle' => 'Prevod podnaslova posta.',
            'body' => 'Prevod teksta posta.',
            'orig_title' => 'Originalni naslov posta.',
            'opis' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }

    /**
     * @inheritdoc
     * @return PostTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostTranslationQuery(get_called_class());
    }
}
