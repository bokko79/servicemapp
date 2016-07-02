<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * CartForm is the model behind the adding a service to user's shopping cart.
 */
class CartForm extends Model
{
    public $key;
    public $industry;
    public $service; // izabrana usluga
    public $type;
    public $presentation;
    public $object_models;
    public $skills = [];
    public $imageFiles = [];
    public $youtube_link;
    public $issues = [];
    public $user_object;
    public $item_count;
    public $amount;
    public $amount_to;
    public $amount_operator;
    /*public $consumer;
    public $consumer_to;
    public $consumer_operator;
    public $consumer_children;*/
    public $note;
    public $title;
    public $issue_text;
    public $installation;
    public $shipping;
    public $checkUserObject = 0; // proverava da li su unete specifikacije

    private $_service;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $service = $this->service;
        // amount
        $amount = ($service->amount==1) ? ['amount', 'required', 'message'=>Yii::t('app', 'Unesite količinu usluge u datoj jedinici mere.')] : ['amount', 'safe'];        
        //$consumer = ($service->consumer==1) ? ['consumer', 'required', 'message'=>Yii::t('app', 'Unesite broj odraslih koji će koristiti ovu uslugu.')] : ['consumer', 'safe'];
        //$consumer_children = ($service->consumer!=0 && $service->consumer_children==1) ? ['consumer_children', 'required', 'message'=>Yii::t('app', 'Unesite broj dece koja će koristiti ovu uslugu.')] : ['consumer_children', 'safe'];
        $pic = ($service->pic==1) ? [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, pdf', 'maxFiles' => 12, 'maxSize' => 1024*1024*20, 'tooMany'=>'Možete prikačiti najviše 12 dokumenata.'] : ['imageFiles', 'safe'];      
        
        return [
            ['service', 'required'],
            [['item_count'] , 'integer'],
            $amount,
            ['amount', 'number', 'min'=>$service->amount_range_min, 'max'=>$service->amount_range_max],
            ['amount_operator', 'default', 'value'=>'exact'],
            //$consumer,
            //$consumer_children,
            [[/*'consumer_children', */'amount_to', /*'consumer_to'*/], 'integer'],
            //['consumer', 'integer', 'min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max],
            //['consumer_operator', 'default', 'value'=>'exact'],
            ['title', 'string', 'max' => 64], 
            [['note', 'issue_text', 'youtube_link'], 'string'], 
            [['youtube_link'], 'string', 'max' => 256],
            [['youtube_link'], 'url', 'pattern'=>'/^https:\/\/(?:www\.)?(?:youtube.com|youtu.be)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/'],           
            [['title', 'note'], 'filter', 'filter' => 'trim'],
            //$pic,
            [['skills', 'type', 'presentation'], 'safe'],
            ['user_object', 'required', 'when' => function ($model) {
                return false;
            }, 'whenClient' => "function (attribute, value) {
                return $('#checkUserObject_model').val() == 1;
            }", 'message'=>Yii::t('app', 'Morate izabrati sačuvani {object} ili opisati novi.', ['object'=>$this->service->object->tNameAkk])]
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
            //'consumer' => Yii::t('app', 'Broj korisnika'),
            //'consumer_children' => Yii::t('app', 'Broj dece'),
            'item_count' => Yii::t('app', 'Broj ').$service->object->tNameGen,
            'imageFiles' => Yii::t('app', 'Slike'),
            'note' => Yii::t('app', 'Napomena'),
            'title' => Yii::t('app', 'Naslov'), 
            'user_object' => Yii::t('app', 'Vaš predmet'),        
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

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $key_f=>$file) {
                $fileName = Yii::$app->security->generateRandomString();
                if($file->extension=='pdf'){
                    $file->saveAs('images/orders/docs/' . $fileName . '.' . $file->extension);
                } else {
                    $file->saveAs('images/orders/' . $fileName . '1.' . $file->extension);
                }
                
                $image[$key_f] = new \common\models\Images();
                $image[$key_f]->ime = $fileName . '.' . $file->extension;
                $image[$key_f]->type = $file->extension=='pdf' ? 'pdf' : 'image';
                $image[$key_f]->base_encode = $file->baseName.'.'. $file->extension;
                $image[$key_f]->date = date('Y-m-d H:i:s');
                if($file->extension!='pdf'){
                   $thumb = '@webroot/images/orders/'.$fileName.'1.'.$file->extension;
                    Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('@webroot/images/orders/'.$fileName.'.'.$file->extension), ['quality' => 80]);
                    Image::thumbnail($thumb, 1920, 1200)->save(Yii::getAlias('@webroot/images/orders/full/'.$fileName.'.'.$file->extension), ['quality' => 80]);
                    Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('@webroot/images/orders/thumbs/'.$fileName.'.'.$file->extension), ['quality' => 80]); 
                }  
                $image[$key_f]->save();                  
                /*if($image[$key_f]->save()){
                    $presentation_image[$key_f] = new \common\models\PresentationImages();
                    $presentation_image[$key_f]->presentation_id = $this->id;
                    $presentation_image[$key_f]->image_id = $image[$key_f]->id;
                    $presentation_image[$key_f]->type = $image[$key_f]->type;
                    $presentation_image[$key_f]->save();
                }*/
                if($file->extension!='pdf'){
                    unlink(Yii::getAlias($thumb));
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /*public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $key_f=>$file) {
                $file->saveAs('images/user_objects/' . $file->baseName . '.' . $file->extension);
                $image[$key_f] = new \common\models\Images();
                $image[$key_f]->ime = $file->baseName . '.' . $file->extension;
                $image[$key_f]->type = 'image';
                $image[$key_f]->date = date('Y-m-d H:i:s');
                $image[$key_f]->save();
            }
            return true;
        } else {
            return false;
        }
    }  */  

    public function checkIfMethods()
    {
        return ($this->service->serviceActionProperties) ? 0 : 1;
    }

    public function checkIfSpecs()
    {
        return ($this->service->serviceObjectProperties!=null) ? 0 : 1;
    }

    public function checkIfPic()
    {
        return ($this->service->pic==1 and $this->service->object_ownership=='user') ? 0 : 1;
    }

    public function checkIfIssues()
    {
        return ($this->service->service_type==3 && $this->service->object->issues!=null) ? 0 : 1;
    }

    public function checkIfAmount()
    {
        return ($this->service->amount!=0) ? 0 : 1;
    }   

    public function getNoPic()
    {
        return 2-$this->checkIfSpecs();
    }

    public function getNoIssues()
    {
        return 3-$this->checkIfSpecs()-$this->checkIfPic();
    }

    public function getNoAmount()
    {
        return 4-$this->checkIfSpecs()-$this->checkIfPic()-$this->checkIfIssues();
    }    

    public function getNoMethods()
    {
        return 5-$this->checkIfSpecs()-$this->checkIfPic()-$this->checkIfIssues()-$this->checkIfAmount();
    }

    public function getNoOther()
    {
        return 6-$this->checkIfSpecs()-$this->checkIfPic()-$this->checkIfIssues()-$this->checkIfAmount()-$this->checkIfMethods();
    }

    public function getNoProcess()
    {
        return 7-$this->checkIfSpecs()-$this->checkIfPic()-$this->checkIfIssues()-$this->checkIfAmount()-$this->checkIfMethods();
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceSpecs|null
     */
    public function serviceObjectProperties()
    {
        $service = $this->getService();
        if($service) {
            return $service->serviceObjectProperties;
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

        /*if(!isset($_SESSION['cart']['industry'][$this->service->industry_id])){
            $_SESSION['cart']['industry'][$this->service->industry_id] = [            
                'skills' => $this->skills,                
            ];
        }*/
        
        $_SESSION['cart']['industry'][$this->service->industry_id]['data'][$this->key] = [
            'service' => $this->getService()->id,
            'type' => $this->type,
            'presentation' => $this->presentation,
            'object_models' => $this->object_models,
            'item_count' => $this->item_count,
            'amount' => $this->amount,
            'amount_to' => $this->amount_to,
            'amount_operator' => $this->amount_operator,
            /*'consumer' => $this->consumer,
            'consumer_to' => $this->consumer_to,
            'consumer_operator' => $this->consumer_operator,
            'consumer_children' => $this->consumer_children,*/
            'note' => $this->note,
            'title' => $this->title,
            'issue_text' => $this->issue_text,
            'images' => $this->imageFiles,
            'youtube_link' => $this->youtube_link,
            'issues' => $this->issues,
            'user_object' => $this->user_object,
            /*'shipping' => $this->shipping,
            'installation' => $this->installation,*/            
            // specifications
            // methods
            // process
        ];

        return true;
    }
}