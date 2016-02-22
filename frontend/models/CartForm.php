<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\Session;
/**
 * CartForm is the model behind the adding a service to user's shopping cart.
 */
class CartForm extends Model
{
    public $key;
    public $service; // izabrana usluga
    public $object_models;
    public $skills = [];
    public $imageFiles = [];
    public $issues = [];
    public $user_object;
    public $amount;
    public $amount_to;
    public $amount_operator;
    public $consumer;
    public $consumer_to;
    public $consumer_operator;
    public $consumer_children;
    public $note;
    public $title;

    private $_service;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $service = $this->service;
        // amount
        $amount = ($service->amount==1) ? ['amount', 'required', 'message'=>Yii::t('app', 'Unesite količinu usluge u datoj jedinici mere.')] : ['amount', 'safe'];        
        $consumer = ($service->consumer==1) ? ['consumer', 'required', 'message'=>Yii::t('app', 'Unesite broj odraslih koji će koristiti ovu uslugu.')] : ['consumer', 'safe'];
        $consumer_children = ($service->consumer!=0 && $service->consumer_children==1) ? ['consumer_children', 'required', 'message'=>Yii::t('app', 'Unesite broj dece koja će koristiti ovu uslugu.')] : ['consumer_children', 'safe'];
        $pic = ($service->pic==1) ? [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 8, 'tooMany'=>'Možete prikačiti najviše 8 fotografija.'] : ['imageFiles', 'safe'];      

        return [
            ['service', 'required'],
            $amount,
            ['amount', 'number', 'min'=>$service->amount_range_min, 'max'=>$service->amount_range_max],
            ['amount_operator', 'default', 'value'=>'exact'],
            $consumer,
            $consumer_children,
            [['consumer_children', 'amount_to', 'consumer_to'], 'integer'],
            ['consumer', 'integer', 'min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max],
            ['consumer_operator', 'default', 'value'=>'exact'],
            ['title', 'string', 'max' => 64], 
            ['note', 'string'],            
            [['title', 'note'], 'filter', 'filter' => 'trim'],
            $pic,
            [['skills'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $service = $this->getService();
        $required = ' *';
        $amount = ($service->amount==1) ? $required : null;
        return [
            'amount' => Yii::t('app', 'Količina').$amount,
            'consumer' => Yii::t('app', 'Broj korisnika'),
            'consumer_children' => Yii::t('app', 'Broj dece'),
            'imageFiles' => Yii::t('app', 'Slike'),
            'note' => Yii::t('app', 'Napomena'),
            'title' => Yii::t('app', 'Naslov'),        
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getService()
    {
        if ($this->_service === null) {
            $this->_service = $this->service;
        }
        return $this->_service;
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceSpecs|null
     */
    public function serviceSpecs()
    {
        $service = $this->getService();
        if($service) {
            return $service->serviceSpecs;
        }
        return false;
    }

    /**
     * Stores service with all settings to user's shopping cart.
     *
     * @return User|null the saved model or null if storing fails
     */
    public function storeToCart()
    {
        if (!$this->validate()) {
            return false;         
        }

        if(!isset($_SESSION['cart']['industry'][$this->service->industry_id])){
            $_SESSION['cart']['industry'][$this->service->industry_id] = [            
                'skills' => $this->skills,
            ];
        }
        
        $_SESSION['cart']['industry'][$this->service->industry_id]['data'][$this->key] = [
            'service' => $this->getService()->id,
            'object_models' => $this->object_models,
            'amount' => $this->amount,
            'amount_to' => $this->amount_to,
            'amount_operator' => $this->amount_operator,
            'consumer' => $this->consumer,
            'consumer_to' => $this->consumer_to,
            'consumer_operator' => $this->consumer_operator,
            'consumer_children' => $this->consumer_children,
            'note' => $this->note,
            'title' => $this->title,
            'images' => $this->imageFiles,
            'issues' => $this->issues,
            // specifications
            // methods
            // process
        ];

        return true;
    }
}