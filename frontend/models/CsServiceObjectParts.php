<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_service_object_part_specs".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $object_part_id
 * @property integer $requirement
 * @property string $description
 */
class CsServiceObjectParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_object_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'object_part_id'], 'required'],
            [['service_id', 'object_part_id', 'requirement'], 'integer'],
            [['description'], 'string'],
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
            'object_part_id' => Yii::t('app', 'Object Part Spec ID'),
            'requirement' => Yii::t('app', 'Requirement'),
            'description' => Yii::t('app', 'Description'),
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
    public function getObjectPart()
    {
        return $this->hasOne(CsObjectParts::className(), ['id' => 'object_part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->objectPart->object;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPart()
    {
        return $this->objectPart->part;
    }
}
