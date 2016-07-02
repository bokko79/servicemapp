<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_recommended_services".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $rcmd_service_id
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Usluga.',
            'rcmd_service_id' => 'Preporučena, slična, srodna ili povezana usluga usluzi iz kolone service_id.',
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
