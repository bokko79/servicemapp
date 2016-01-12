<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_service_processes".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $service_id
 * @property integer $service_order_no
 * @property string $description
 *
 * @property CsProcesses $process
 * @property CsServices $service
 */
class CsServiceProcesses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_processes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_id', 'service_id', 'service_order_no'], 'required'],
            [['process_id', 'service_id', 'service_order_no'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'process_id' => Yii::t('app', 'Process ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'service_order_no' => Yii::t('app', 'Service Order No'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(CsProcesses::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }
}
