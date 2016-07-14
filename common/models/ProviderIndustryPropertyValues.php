<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_industry_property_values".
 *
 * @property string $id
 * @property string $provider_industry_property_id
 * @property string $property_value_id
 */
class ProviderIndustryPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_industry_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_industry_property_id', 'property_value_id'], 'required'],
            [['provider_industry_property_id', 'property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_industry_property_id' => Yii::t('app', 'Provider Industry Property ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
        ];
    }
}
