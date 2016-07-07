<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_industry_properties".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $industry_property_id
 * @property integer $requirement
 */
class CsServiceIndustryProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_industry_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'industry_property_id'], 'required'],
            [['service_id', 'industry_property_id', 'requirement', 'readOnly'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'industry_property_id' => Yii::t('app', 'Industry Property'),
            'requirement' => Yii::t('app', 'Requirement'),
            'readOnly' => Yii::t('app', 'Read Only'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustryProperty()
    {
        return $this->hasOne(CsIndustryProperties::className(), ['id' => 'industry_property_id']);
    }
}
