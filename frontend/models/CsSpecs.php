<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_specs".
 *
 * @property string $id
 * @property integer $object_id
 * @property string $object
 * @property integer $attribute_id
 * @property string $attribute
 * @property string $type
 * @property integer $range_min
 * @property string $range_max
 * @property integer $range_step
 * @property string $req_opt
 * @property string $description
 *
 * @property CsServiceSpecs[] $csServiceSpecs
 * @property CsObjects $object0
 * @property CsAttributes $attribute0
 * @property OrderServiceSpecs[] $orderServiceSpecs
 * @property ProviderServiceSpecs[] $providerServiceSpecs
 */
class CsSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'attribute_id', 'type'], 'required'],
            [['object_id', 'attribute_id', 'range_min', 'range_max', 'range_step'], 'integer'],
            [['type', 'description'], 'string'],
            [['object', 'attribute'], 'string', 'max' => 64],
            [['req_opt'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object' => Yii::t('app', 'Object'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'attribute' => Yii::t('app', 'Attribute'),
            'type' => Yii::t('app', 'Type'),
            'range_min' => Yii::t('app', 'Range Min'),
            'range_max' => Yii::t('app', 'Range Max'),
            'range_step' => Yii::t('app', 'Range Step'),
            'req_opt' => Yii::t('app', 'Req Opt'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceSpecs()
    {
        return $this->hasMany(CsServiceSpecs::className(), ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject0()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(CsAttributes::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceSpecs()
    {
        return $this->hasMany(OrderServiceSpecs::className(), ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceSpecs()
    {
        return $this->hasMany(ProviderServiceSpecs::className(), ['spec_id' => 'id']);
    }
}
