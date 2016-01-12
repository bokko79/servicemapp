<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_similar_industries".
 *
 * @property integer $id
 * @property integer $industry_id
 * @property integer $similar_industry_id
 * @property string $description
 *
 * @property CsIndustries $industry
 * @property CsIndustries $similarIndustry
 */
class CsSimilarIndustries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_similar_industries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_id', 'similar_industry_id'], 'required'],
            [['industry_id', 'similar_industry_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'industry_id' => 'Uslužna delatnost.',
            'similar_industry_id' => 'Slična uslužna delatnost (onoj iz kolone delatnost_id).',
            'description' => 'Opis stavke.',
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
    public function getSimilarIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'similar_industry_id']);
    }

    /**
     * @inheritdoc
     * @return CsSimilarIndustriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSimilarIndustriesQuery(get_called_class());
    }
}
