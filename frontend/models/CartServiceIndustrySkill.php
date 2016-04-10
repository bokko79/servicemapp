<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
/**
 * CartServiceActionMethod is the model behind the adding a service to user's shopping cart.
 */
class CartServiceIndustrySkill extends Model
{    
    public $key;
    public $service;
    public $serviceSkill;
    public $property;
    public $skill;
    public $skill_models = [];

    private $_skill;
    private $_property;

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        $industrySkill = $this->getIndustrySkill();
        $property = $this->getProperty();
        $skill_validation_requirement = ($industrySkill->required) ? ['skill', 'required', 'message'=>Yii::t('app', 'Unesite {skill_name}', ['skill_name'=>$property->tNameAkk])] : ['skill', 'safe'];
        switch ($property->type) {
            case 1:
                $skill_validation_type = ['skill', 'integer', 'message'=>Yii::t('app', 'Vrednost "{skill_name}" mora biti broj', ['skill_name'=>$property->tName])];
                break;

            case 6:
                $skill_validation_type = ['skill', 'string'];
                break;
            
            default:
                $skill_validation_type = ['skill', 'safe'];
                break;
        }

        return [
            $skill_validation_requirement,
            $skill_validation_type,
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceMethods|null
     */
    public function getIndustrySkill()
    {
        if ($this->_skill === null) {
            $this->_skill = $this->serviceSkill;
        }
        return $this->_skill;
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
        $_SESSION['cart']['industry'][$this->service->industry_id]['data'][$this->key]['skills'][$this->getProperty()->id] = [
            'skill' => $this->skill,
            'skill_models' => $this->skill_models,
            'property' => $this->property->id,
            'industrySkill' => $this->serviceSkill->id,
        ];
        return true;
    }
}