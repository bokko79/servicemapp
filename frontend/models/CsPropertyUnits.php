<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_property_units".
 *
 * @property string $id
 * @property integer $property_id
 * @property string $property_name
 * @property integer $unit_id
 * @property string $unit_name
 * @property integer $main
 * @property string $description
 */
class CsPropertyUnits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'property_name', 'unit_id', 'unit_name'], 'required'],
            [['property_id', 'unit_id', 'main'], 'integer'],
            [['description'], 'string'],
            [['property_name', 'unit_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'unit_name' => Yii::t('app', 'Unit Name'),
            'main' => Yii::t('app', 'Main'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }
}
