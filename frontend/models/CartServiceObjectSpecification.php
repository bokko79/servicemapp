<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceObjectSpecification is the model behind the adding a service to user's shopping cart.
 */
class CartServiceObjectSpecification extends PresentationSpecs
{
    public $key;
    public $service;
    public $specification;
    public $cart; // to connect to CartForm Model
    public $property;
    public $spec;    
    public $spec_models = [];
    public $spec_to;
    public $spec_operator;
    public $checkUserObject;
    public $checkIfRequired;

    private $_specification;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $objectSpec = $this->getObjectSpecification();
        $property = $this->property;
        switch ($property->type) {
            case 1:
                if($this->service->service_object!=1){ // number
                    $spec_validation_type = ['spec', 'number', 'message'=>Yii::t('app', 'Vrednost "{specification_name}" mora biti broj', ['specification_name'=>$property->tName])];
                    $spec_to_validation_type = ['spec_to', 'safe'];
                } else { // range
                    $spec_validation_type = ['spec', 'number', 'min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max])];
                    $spec_to_validation_type = ['spec_to', 'number', 'min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max])];
                }                
                break;

            case 4:
                $spec_validation_type = ['spec', 'safe'];
                $spec_to_validation_type = ['spec_to', 'safe'];
                break;
            
            default:
                $spec_validation_type = ['spec', 'filter', 'filter'=>'trim'];
                $spec_to_validation_type = ['spec_to', 'safe'];
        }

        return [
            $spec_validation_type,
            $spec_to_validation_type,
            [['spec_models'] , 'safe'],            
            ['spec_operator', 'default', 'value'=>'exact'],
            ['spec', 'required', 'when' => function ($model) {
                return false;
            }, 'whenClient' => "function (attribute, value) {
                return ($('#checkUserObject_model_spec".$this->property->id."').val() == 1 && $('#checkIfRequired_model_spec".$this->property->id."').val() == 1);
            }", 'message'=>Yii::t('app', 'Unesite {specification_name}', ['specification_name'=>$property->tNameAkk])]
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
            'spec' => $this->spec,
            'spec_models' => $this->spec_models,
            'spec_to' => $this->spec_to,            
            'spec_operator' => $this->spec_operator,
            'property' => $this->property->id,
            'objectSpec' => $this->specification->id,
        ];    
        return true;
    }
}