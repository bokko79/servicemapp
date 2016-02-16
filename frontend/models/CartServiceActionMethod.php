<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceActionMethod is the model behind the adding a service to user's shopping cart.
 */
class CartServiceActionMethod extends Model
{    
    public $key;
    public $service;
    public $serviceMethod;
    public $property;
    public $method;
    public $method_models = [];

    private $_method;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $actionMethod = $this->getActionMethod();
        $property = $this->getProperty();
        $method_validation_requirement = ($actionMethod->required) ? ['method', 'required', 'message'=>Yii::t('app', 'Unesite {method_name}', ['method_name'=>$property->tNameAkk])] : ['method', 'safe'];
        switch ($property->type) {
            case 1:
                $method_validation_type = ['method', 'integer', 'message'=>Yii::t('app', 'Vrednost "{method_name}" mora biti broj', ['method_name'=>$property->tName])];
                break;

            case 4:
                $method_validation_type = ['method', 'safe'];
                break;

            case 6:
                $method_validation_type = ['method', 'string'];
                break;
            
            default:
                $method_validation_type = ['method', 'safe'];
                break;
        }

        return [
            $method_validation_requirement,
            $method_validation_type,
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
            $this->_method = $this->serviceMethod;
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
     * Stores service action methods with all settings to user's shopping cart.
     *
     * @return $_SESSION['cart']|null the saved model or null if storing fails
     */
    public function store()
    {
        if (!$this->validate()) {
            return false;         
        }
        $_SESSION['cart']['industry'][$this->service->industry_id][$this->key]['methods'][$this->getProperty()->id] = [
            'method' => $this->method,
            'method_models' => $this->method_models,
            'property' => $this->property->id,
            'actionMethod' => $this->serviceMethod->id,
        ];
        return true;
    }
}