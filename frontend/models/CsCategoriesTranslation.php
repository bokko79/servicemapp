<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_categories_translation".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsCategories $category
 */
class CsCategoriesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_categories_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'lang_code', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
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
    public function getCategory()
    {
        return $this->hasOne(CsCategories::className(), ['id' => 'category_id']);
    }
}
