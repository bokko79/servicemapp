<?php

namespace common\models;

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
            'id' => 'ID',
            'service_id' => 'Usluga',
            'regulation_id' => 'Zakonska regulativa',
            'description' => 'Opis stavke',
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

    /**
     * @inheritdoc
     * @return CsServiceRegulationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServiceRegulationsQuery(get_called_class());
    }
}
