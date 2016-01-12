<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_recommended_services".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $rcmd_service_id
 * @property string $description
 *
 * @property CsServices $service
 * @property CsServices $rcmdService
 */
class CsRecommendedServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_recommended_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'rcmd_service_id'], 'required'],
            [['service_id', 'rcmd_service_id'], 'integer'],
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
            'service_id' => Yii::t('app', 'Service ID'),
            'rcmd_service_id' => Yii::t('app', 'Rcmd Service ID'),
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
    public function getRcmdService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'rcmd_service_id']);
    }
}
