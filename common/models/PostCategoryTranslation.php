<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_category_translation".
 *
 * @property integer $id
 * @property integer $post_category_id
 * @property string $lang_code
 * @property string $ime
 * @property string $orig_ime
 * @property string $opis
 *
 * @property PostCategory $postCategory
 * @property CsLanguages $langCode
 */
class PostCategoryTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_category_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_category_id', 'lang_code', 'ime', 'orig_ime'], 'required'],
            [['post_category_id'], 'integer'],
            [['opis'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['ime', 'orig_ime'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_category_id' => 'Kategorija postova.',
            'lang_code' => 'Jezik.',
            'ime' => 'Prevod imena kategorije postova.',
            'orig_ime' => 'Originalno ime kategorije postova.',
            'opis' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'post_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @inheritdoc
     * @return PostCategoryTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostCategoryTranslationQuery(get_called_class());
    }
}
