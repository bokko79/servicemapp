<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_object_models".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $object_model_id
 * @property integer $requirement
 */
class CsServiceObjectModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_object_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'object_model_id'], 'required'],
            [['service_id', 'object_model_id', 'requirement'], 'integer'],
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
            'object_model_id' => Yii::t('app', 'Object Model ID'),
            'requirement' => Yii::t('app', 'Requirement'),
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
    public function getObjectModel()
    {
        return $this->hasOne(CsObjectModels::className(), ['id' => 'object_model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->objectModel->model_id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSCaseModelName()
    {
        return c($this->objectModel->tName); 
    }
}
