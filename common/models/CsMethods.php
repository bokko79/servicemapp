<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_methods".
 *
 * @property integer $id
 * @property integer $action_id
 * @property integer $action
 * @property integer $property_id
 * @property integer $property
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
            [['action', 'property'], 'string', 'max' => 64],
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
            'action' => Yii::t('app', 'Action'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property' => Yii::t('app', 'Property'),
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

    /**
     * @inheritdoc
     * @return CsMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsMethodsQuery(get_called_class());
    }
}
