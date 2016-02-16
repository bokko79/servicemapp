<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_processes".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $service_count
 * @property string $description
 *
 * @property CsProcessesTranslation[] $csProcessesTranslations
 * @property CsServiceProcesses[] $csServiceProcesses
 * @property Orders[] $orders
 */
class CsProcesses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_processes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'service_count'], 'required'],
            [['type', 'description'], 'string'],
            [['service_count'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'service_count' => Yii::t('app', 'Service Count'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsProcessesTranslation::className(), ['process_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['process_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['process_id' => 'id']);
    }
}
