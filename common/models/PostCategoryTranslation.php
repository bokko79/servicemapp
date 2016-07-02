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
            'id' => Yii::t('app', 'ID'),
            'post_category_id' => Yii::t('app', 'Post Category ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'ime' => Yii::t('app', 'Ime'),
            'orig_ime' => Yii::t('app', 'Orig Ime'),
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
}
