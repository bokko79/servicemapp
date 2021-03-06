<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_object_properties".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $object_property_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 *
 * @property CsSpecs $spec
 * @property Presentations $presentation
 */
class PresentationObjectProperties extends \yii\db\ActiveRecord
{
    public $service;
    public $theObjectProperty;
    public $property;
    public $objectPropertyValues = [];
    public $checkUserObject;

    private $_objectProperty;
    private $_property;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'object_property_id'], 'required'],
            [['presentation_id', 'object_property_id'], 'integer'],
            [['value_operator'], 'string'],
            [['multiple_values', 'read_only'], 'boolean'],
            [['objectPropertyValues'], 'safe'],
            [['value', 'value_max'], 'string', 'max' => 32],
            [['object_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsObjectProperties::className(), 'targetAttribute' => ['object_property_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentations::className(), 'targetAttribute' => ['presentation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
           'presentation_id' => Yii::t('app', 'Presentation ID'),
           'object_property_id' => Yii::t('app', 'Spec ID'),
           'value' => Yii::t('app', 'Value'),
           'value_max' => Yii::t('app', 'Value Max'),
           'value_operator' => Yii::t('app', 'Value Operator'),
        ];
    }

    /**
     * Specification of the object of the service to be added to the cart.
     *
     * @return CsSpecs|null
     */
    public function getTheObjectProperty()
    {
        if ($this->_objectProperty === null) {
            $this->_objectProperty = $this->theObjectProperty;
        }
        return $this->_objectProperty;
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
    public function getObjectProperty()
    {
        return $this->hasOne(CsObjectProperties::className(), ['id' => 'object_property_id']);
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
    public function getPresentationObjectPropertyValues()
    {
        return $this->hasMany(PresentationObjectPropertyValues::className(), ['presentation_object_property_id' => 'id']);
    }

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    public function objectProperties()
    {
        $content = '';
        if($spcf_models = $this->objectPropertyValues or $this->value){
            $content .= '<tr><td style="width:30%; vertical-align:top; color:#999">'.c($this->objectProperty->property->tName).'</td><td>';
            if($spcf_models){   
                $content .= '<ul class="column2">'; 
                foreach($model->object->objectProperties as $ob_spec){
                    $chk = [];                  
                    foreach($spcf_models as $spcf_model){
                        if($spcf_model->id==$ob_spec->id){
                            $chk[] = $spec_model->id;
                            break;
                        }                                       
                    }               
                }
                foreach($model->object->objectProperties as $ob_spec){
                    if(in_array($ob_spec->id, $chk)){
                        $content .= '<li><b><i class="fa fa-check"></i> '.c($ob_spec->property->propertyValue->tName).'</b></li>';  
                    } else {
                        $content .= '<li><b><i class="fa fa-times"></i> '.c($ob_spec->property->propertyValue->tName).'</b></li>';  
                    }                                       
                }                                   
                $content .= '</ul>';
            } else {
                if($this->value){
                    $content .= '<b>'.($this->value_operator=='exact' ? null : $this->value_operator).' ' .$this->value . ($presenation_spec->objectProperty->property->unit ? ' '.$this->objectProperty->property->unit->oznaka : null). '</b>';
                }           
            }

            $content .= '</td></tr>';
        }
        return $content;
    }
}
