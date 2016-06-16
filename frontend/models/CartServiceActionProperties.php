<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceActionProperties is the model behind the adding a service to user's shopping cart.
 */
class CartServiceActionProperties extends Model
{    
    public $key;
    public $service;
    public $serviceActionProperty;
    public $property;
    public $actionProperty;
    public $actionPropertyValues = [];

    private $_actionProperty;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $getActionProperty = $this->getActionProperty();
        $property = $this->getProperty();        
        //$method_validation_requirement = ($getActionProperty->required) ? ['actionProperty', 'required', 'message'=>Yii::t('app', 'Unesite {method_name}', ['method_name'=>$property->tNameAkk])] : ['actionProperty', 'safe'];
        switch ($property->type) {
            case 1:
                $method_validation_type = ['actionProperty', 'integer', 'message'=>Yii::t('app', 'Vrednost "{method_name}" mora biti broj', ['method_name'=>$property->tName])];
                break;

            case 6:
                $method_validation_type = ['actionProperty', 'string'];
                break;
            
            default:
                $method_validation_type = ['actionProperty', 'safe'];
                break;
        }

        return [
           // $method_validation_requirement,
            $method_validation_type,
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceMethods|null
     */
    public function getActionProperty()
    {
        if ($this->_actionProperty === null) {
            $this->_actionProperty = $this->actionProperty;
        }
        return $this->_actionProperty;
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
        $_SESSION['cart']['industry'][$this->service->industry_id]['data'][$this->key]['methods'][$this->getProperty()->id] = [
            'actionProperty' => $this->actionProperty,
            'actionPropertyValues' => $this->actionPropertyValues,
            'property' => $this->property->id,
            'serviceActionProperty' => $this->serviceActionProperty->id,
        ];
        return true;
    }
}