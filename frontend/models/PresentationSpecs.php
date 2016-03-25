<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_specs".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $spec_id
 * @property string $value
 * @property string $value_max
 * @property string $value_operator
 *
 * @property CsSpecs $spec
 * @property Presentations $presentation
 */
class PresentationSpecs extends \yii\db\ActiveRecord
{
    public $service;
    public $specification;
    public $property;
    public $spec_models = [];
    public $checkUserObject;

    private $_specification;
    private $_property;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'spec_id'], 'required'],
            [['presentation_id', 'spec_id'], 'integer'],
            [['value_operator'], 'string'],
            [['multiple_values', 'read_only'], 'boolean'],
            [['spec_models'], 'safe'],
            [['value', 'value_max'], 'string', 'max' => 32],
            [['spec_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsSpecs::className(), 'targetAttribute' => ['spec_id' => 'id']],
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
           'spec_id' => Yii::t('app', 'Spec ID'),
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
    public function getObjectSpecification()
    {
        if ($this->_specification === null) {
            $this->_specification = $this->specification;
        }
        return $this->_specification;
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
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
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
    public function getModels()
    {
        return $this->hasMany(PresentationSpecModels::className(), ['presentation_spec_id' => 'id']);
    }

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    public function objectSpecifications()
    {
        $content = '';
        if($spcf_models = $this->models or $this->value){
            $content .= '<tr><td style="width:30%; vertical-align:top; color:#999">'.c($this->spec->property->tName).'</td><td>';
            if($spcf_models){   
                $content .= '<ul class="column2">'; 
                foreach($model->object->specs as $ob_spec){
                    $chk = [];                  
                    foreach($spcf_models as $spcf_model){
                        if($spcf_model->id==$ob_spec->id){
                            $chk[] = $spec_model->id;
                            break;
                        }                                       
                    }               
                }
                foreach($model->object->specs as $ob_spec){
                    if(in_array($ob_spec->id, $chk)){
                        $content .= '<li><b><i class="fa fa-check"></i> '.c($ob_spec->property->model->tName).'</b></li>';  
                    } else {
                        $content .= '<li><b><i class="fa fa-times"></i> '.c($ob_spec->property->model->tName).'</b></li>';  
                    }                                       
                }                                   
                $content .= '</ul>';
            } else {
                if($this->value){
                    $content .= '<b>'.($this->value_operator=='exact' ? null : $this->value_operator).' ' .$this->value . ($presenation_spec->spec->property->unit ? ' '.$this->spec->property->unit->oznaka : null). '</b>';
                }           
            }

            $content .= '</td></tr>';
        }
        return $content;
    }
}
