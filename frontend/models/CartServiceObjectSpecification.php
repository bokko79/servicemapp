<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceObjectSpecification is the model behind the adding a service to user's shopping cart.
 */
class CartServiceObjectSpecification extends Model
{
    public $key;
    public $service;
    public $specification;
    public $property;
    public $spec;
    public $spec_models = [];
    public $spec_to;

    private $_specification;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $objectSpec = $this->getObjectSpecification();
        $property = $this->property;
        $spec_validation_requirement = ($objectSpec->required) ? ['spec', 'required', 'message'=>Yii::t('app', 'Unesite {specification_name}', ['specification_name'=>$property->tNameAkk])] : ['spec', 'safe'];
        switch ($property->type) {
            case 1:
                if($this->service->service_object=!1){ // number
                    $spec_validation_type = ['spec', 'integer', 'message'=>Yii::t('app', 'Vrednost "{specification_name}" mora biti broj', ['specification_name'=>$property->tName])];
                    $spec_to_validation_type = ['spec_to', 'number'];
                } else { // range
                    $spec_validation_type = ['spec', 'integer', 'min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max])];
                    $spec_to_validation_type = ['spec_to', 'integer', 'min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max, 'message'=>Yii::t('app', 'Mora biti između {min} i {max}', ['min'=>$objectSpec->range_min, 'max'=>$objectSpec->range_max])];
                }                
                break;

            case 4:
                $spec_validation_type = ['spec', 'safe'];
                $spec_to_validation_type = ['spec_to', 'number'];
                break;

            case 6:
                $spec_validation_type = ['spec', 'string'];
                $spec_to_validation_type = ['spec_to', 'number'];
                break;
            
            default:
                $spec_validation_type = ['spec', 'safe'];
                $spec_to_validation_type = ['spec_to', 'number'];
                break;
        }

        return [
            $spec_validation_requirement,
            $spec_validation_type,
            $spec_to_validation_type,
            //[['spec', 'spec_models'] , 'safe'],
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
        $_SESSION['cart']['industry'][$this->service->industry_id][$this->key]['specifications'][$this->getProperty()->id] = [
            'spec' => $this->spec,
            'spec_models' => $this->spec_models,
            'spec_to' => $this->spec_to,
            'property' => $this->property->id,
            'objectSpec' => $this->specification->id,
        ];
        return true;
    }
}