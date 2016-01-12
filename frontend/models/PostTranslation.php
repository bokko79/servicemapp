<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'body' => Yii::t('app', 'Body'),
            'orig_title' => Yii::t('app', 'Orig Title'),
            'opis' => Yii::t('app', 'Opis'),
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
}
