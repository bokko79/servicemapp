<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_specs".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $spec_id
 * @property integer $requirement
 * @property string $description
 *
 * @property CsServices $service
 * @property CsSpecs $spec
 */
class CsServiceSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'spec_id', 'requirement'], 'required'],
            [['service_id', 'spec_id', 'requirement'], 'integer'],
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
            'spec_id' => 'Specifikacija predmeta usluge.',
            'requirement' => 'Requirement',
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
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }

    /**
     * @inheritdoc
     * @return CsServiceSpecsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServiceSpecsQuery(get_called_class());
    }
}
