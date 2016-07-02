<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_category".
 *
 * @property integer $id
 * @property string $ime
 * @property string $sub_cat
 *
 * @property PostCategoryTranslation[] $postCategoryTranslations
 * @property Posts[] $posts
 */
class PostCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ime'], 'required'],
            [['ime'], 'string', 'max' => 64],
            [['sub_cat'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ime' => Yii::t('app', 'Ime'),
            'sub_cat' => Yii::t('app', 'Sub Cat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategoryTranslations()
    {
        return $this->hasMany(PostCategoryTranslation::className(), ['post_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['post_category_id' => 'id']);
    }
}
