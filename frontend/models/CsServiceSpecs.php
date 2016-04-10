<?php

namespace frontend\models;

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
            [['service_id', 'spec_id', 'requirement', 'readOnly'], 'integer'],
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
            'spec_id' => Yii::t('app', 'Spec ID'),
            'requirement' => Yii::t('app', 'Requirement'),
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
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }
}
