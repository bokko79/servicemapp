<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_object_specs".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $object_property_id
 * @property integer $requirement
 * @property integer $readOnly
 */
class CsServiceObjectProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_object_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'object_property_id'], 'required'],
            [['service_id', 'object_property_id', 'requirement', 'readOnly'], 'integer'],
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
            'object_property_id' => Yii::t('app', 'Object Property ID'),
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
    public function getObjectProperty()
    {
        return $this->hasOne(CsObjectProperties::className(), ['id' => 'object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceObjectPropertyValues()
    {
        return $this->hasMany(CsServiceObjectPropertyValues::className(), ['service_object_property_id' => 'id']);
    }
}
