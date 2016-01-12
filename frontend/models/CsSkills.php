<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_skills".
 *
 * @property integer $id
 * @property integer $industry_id
 * @property integer $attribute_id
 * @property string $description
 *
 * @property CsIndustries $industry
 * @property CsAttributes $attribute
 */
class CsSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_id', 'attribute_id'], 'required'],
            [['industry_id', 'attribute_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute()
    {
        return $this->hasOne(CsAttributes::className(), ['id' => 'attribute_id']);
    }
}
