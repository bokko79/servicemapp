<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_categories".
 *
 * @property integer $id
 * @property integer $sector_id
 * @property string $name
 * @property string $description
 *
 * @property CsSectors $sector
 * @property CsCategoriesTranslation[] $csCategoriesTranslations
 * @property CsIndustries[] $csIndustries
 */
class CsCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector_id', 'name'], 'required'],
            [['sector_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sector_id' => Yii::t('app', 'Sector ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(CsSectors::className(), ['id' => 'sector_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsCategoriesTranslations()
    {
        return $this->hasMany(CsCategoriesTranslation::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustries()
    {
        return $this->hasMany(CsIndustries::className(), ['category_id' => 'id']);
    }
}
