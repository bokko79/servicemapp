<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_industry_property_values".
 *
 * @property string $id
 * @property string $service_industry_property_id
 * @property string $industry_property_value_id
 * @property integer $selected_value
 */
class CsServiceIndustryPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_industry_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_industry_property_id', 'industry_property_value_id', 'selected_value'], 'required'],
            [['service_industry_property_id', 'industry_property_value_id', 'selected_value'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_industry_property_id' => Yii::t('app', 'Service Industry Property ID'),
            'industry_property_value_id' => Yii::t('app', 'Industry Property Value ID'),
            'selected_value' => Yii::t('app', 'Selected Value'),
        ];
    }
}
