<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_action_properties".
 *
 * @property string $id
 * @property string $presentation_id
 * @property integer $action_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 *
 * @property CsMethods $method
 * @property Presentations $presentation
 */
class PresentationActionProperties extends \yii\db\ActiveRecord
{
    public $service;
    public $csMethod;
    public $property;
    public $method_models = [];

    private $_method;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_action_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'action_property_id'], 'required'],
            [['presentation_id', 'action_property_id'], 'integer'],
            [['value_operator'], 'string'],
            [['multiple_values', 'read_only'], 'boolean'],
            [['value', 'value_max'], 'string', 'max' => 64],
            [['method_models'], 'safe'],
            [['action_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsActionProperties::className(), 'targetAttribute' => ['action_property_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentations::className(), 'targetAttribute' => ['presentation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'presentation_id' => 'Presentation ID',
            'action_property_id' => 'Method ID',
            'value' => 'Value',
            'value_max' => 'Value Max',
            'value_operator' => Yii::t('app', 'Value Operator'),
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceMethods|null
     */
    public function getActionMethod()
    {
        if ($this->_method === null) {
            $this->_method = $this->csMethod;
        }
        return $this->_method;
    }

    /**
     * Property of the object.
     *
     * @return CsProperties|null
     */
    public function getProperty()
    {
        if ($this->_property === null) {
            $this->_property = $this->property;
        }
        return $this->_property;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionProperty()
    {
        return $this->hasOne(CsActionProperties::className(), ['id' => 'action_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationActionPropertyValues()
    {
        return $this->hasMany(PresentationActionPropertyValues::className(), ['presentation_action_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function value()
    {
        return \frontend\models\CsPropertyValues::findOne($this->value);
    }
}
