<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_similar_services".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $sim_service_id
 * @property string $description
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
            [['description'], 'string']
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
            'sim_service_id' => 'Slična usluga onoj iz kolone service_id.',
            'description' => 'Opis stavke.',
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

    /**
     * @inheritdoc
     * @return CsSimilarServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSimilarServicesQuery(get_called_class());
    }
}
