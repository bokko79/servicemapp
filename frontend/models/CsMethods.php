<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_methods".
 *
 * @property integer $id
 * @property integer $action_id
 * @property integer $action_name
 * @property integer $property_id
 * @property integer $property_name
 * @property string $type
 * @property integer $required
 *
 * @property CsActions $action
 * @property CsAttributes $attribute
 * @property OrderServiceMethods[] $orderServiceMethods
 * @property PresentationMethods[] $presentationMethods
 */
class CsMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'property_id', 'type'], 'required'],
            [['action_id', 'property_id', 'required'], 'integer'],
            [['type'], 'string'],
            [['action_name', 'property_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'action_name' => Yii::t('app', 'Action'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property'),
            'type' => Yii::t('app', 'Type'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
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
    public function getOrderServiceMethods()
    {
        return $this->hasMany(OrderServiceMethods::className(), ['method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationMethods()
    {
        return $this->hasMany(PresentationMethods::className(), ['method_id' => 'id']);
    }
}
