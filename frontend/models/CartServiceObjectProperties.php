<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceObjectSpecification is the model behind the adding a service to user's shopping cart.
 */
class CartServiceObjectProperties extends PresentationObjectProperties
{
    public $key;
    public $service;
    public $objectProperty;
    public $cart; // to connect to CartForm Model
    public $property;
    public $value; // $spec;
    public $objectPropertyValues = []; // $spec_models
    public $value_max; // $spec_to;
    public $value_operator; // $spec_operator;
    public $checkUserObject;
    public $checkIfRequired;

    private $_objectProperty;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $objectProperty = $this->getObjectProperty();
        $property = $this->property;
        switch ($property->type) {
            case 1:
                if($this->service->object_ownership=='user'){ // number
                    $value_validation_type = ['value', 'number', 'message'=>Yii::t('app', 'Vrednost "{specification_name}" mora biti broj', ['specification_name'=>$property->tName])];
                    $value_max_validation_type = ['value_max', 'safe'];
                } else { // range
                    $value_validation_type = ['value', 'number', 'min'=>$objectProperty->value_min, 'max'=>$objectProperty->value_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectProperty->value_min, 'max'=>$objectProperty->value_max])];
                    $value_max_validation_type = ['value_max', 'number', 'min'=>$objectProperty->value_min, 'max'=>$objectProperty->value_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectProperty->value_min, 'max'=>$objectProperty->value_max])];
                }                
                break;

            case 4:
                $value_validation_type = ['value', 'safe'];
                $value_max_validation_type = ['value_max', 'safe'];
                break;
            
            default:
                $value_validation_type = ['value', 'filter', 'filter'=>'trim'];
                $value_max_validation_type = ['value_max', 'safe'];
        }

        return [
            $value_validation_type,
            $value_max_validation_type,
            [['objectPropertyValues'] , 'safe'],            
            ['value_operator', 'default', 'value'=>'exact'],
            ['value', 'required', 'when' => function ($model) {
                return false;
            }, 'whenClient' => "function (attribute, value) {
                return ($('#checkUserObject_model_spec".$this->property->id."').val() == 1 && $('#checkIfRequired_model_spec".$this->property->id."').val() == 1);
            }", 'message'=>Yii::t('app', 'Unesite {objectProperty_name}', ['objectProperty_name'=>$property->tNameAkk])]
        ];
    }

    /**
     * Specification of the object of the service to be added to the cart.
     *
     * @return CsSpecs|null
     */
    public function getObjectProperty()
    {
        if ($this->_objectProperty === null) {
            $this->_objectProperty = $this->objectProperty;
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
     * Stores service object specifiations with all settings to user's shopping cart.
     *
     * @return $_SESSION['cart']|null the saved model or null if storing fails
     */
    public function store()
    {
        if (!$this->validate()) {
            return false;         
        }
        $_SESSION['cart']['industry'][$this->service->industry_id]['data'][$this->key]['specifications'][$this->getProperty()->id] = [
            'value' => $this->value,
            'objectPropertyValues' => $this->objectPropertyValues,
            'value_max' => $this->value_max,            
            'value_operator' => $this->value_operator,
            'property' => $this->property->id,
            'objectProperty' => $this->objectProperty->id,
        ];    
        return true;
    }
}