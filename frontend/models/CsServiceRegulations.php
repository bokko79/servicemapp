<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_service_regulations".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $regulation_id
 * @property string $description
 *
 * @property CsServices $service
 * @property CsRegulations $regulation
 */
class CsServiceRegulations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_regulations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'regulation_id'], 'required'],
            [['service_id', 'regulation_id'], 'integer'],
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
            'regulation_id' => Yii::t('app', 'Regulation ID'),
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
    public function getRegulation()
    {
        return $this->hasOne(CsRegulations::className(), ['id' => 'regulation_id']);
    }
}
