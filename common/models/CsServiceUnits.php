<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_units".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $unit_id
 * @property integer $default_unit
 */
class CsServiceUnits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'unit_id'], 'required'],
            [['service_id', 'unit_id', 'default_unit'], 'integer'],
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'default_unit' => Yii::t('app', 'Default Unit'),
        ];
    }

    /**
     * @inheritdoc
     * @return CsServiceUnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServiceUnitsQuery(get_called_class());
    }
}
