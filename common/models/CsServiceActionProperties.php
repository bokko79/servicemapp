<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_action_properties".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $action_property_id
 * @property integer $requirement
 *
 * @property CsServices $service
 * @property CsMethods $method
 */
class CsServiceActionProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_action_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'action_property_id', 'requirement'], 'required'],
            [['service_id', 'action_property_id', 'requirement', 'readOnly'], 'integer'],
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
            'action_property_id' => Yii::t('app', 'Action Property ID'),
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
    public function getActionProperty()
    {
        return $this->hasOne(CsActionProperties::className(), ['id' => 'action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceActionPropertyValues()
    {
        return $this->hasMany(CsServiceActionPropertyValues::className(), ['service_action_property_id' => 'id']);
    }
}
