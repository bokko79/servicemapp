<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_action_property_values".
 *
 * @property string $id
 * @property string $service_action_property_id
 * @property string $action_property_value_id
 */
class CsServiceActionPropertyValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_action_property_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_action_property_id', 'action_property_value_id'], 'required'],
            [['service_action_property_id', 'action_property_value_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_action_property_id' => Yii::t('app', 'Service Action Property ID'),
            'action_property_value_id' => Yii::t('app', 'Action Property Value ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceActionProperty()
    {
        return $this->hasOne(CsServiceActionProperties::className(), ['id' => 'service_action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionPropertyValue()
    {
        return $this->hasOne(CsActionPropertyValues::className(), ['id' => 'action_property_value_id']);
    }
}
