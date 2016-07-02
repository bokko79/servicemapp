<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_similar_services".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $sim_service_id
 *
 * @property CsServices $service
 * @property CsServices $simService
 */
class CsSimilarServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_similar_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'sim_service_id'], 'required'],
            [['service_id', 'sim_service_id'], 'integer'],
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
            'sim_service_id' => Yii::t('app', 'Sim Service ID'),
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
    public function getSimService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'sim_service_id']);
    }
}
