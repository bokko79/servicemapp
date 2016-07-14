<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_industry_property_values".
 *
 * @property string $id
 * @property string $industry_property_id
 * @property string $property_value_id
 * @property integer $selected_value
 */
class CsIndustryPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_industry_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_property_id', 'property_value_id'], 'required'],
            [['industry_property_id', 'property_value_id', 'selected_value'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'industry_property_id' => Yii::t('app', 'Industry Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
        ];
    }
}
