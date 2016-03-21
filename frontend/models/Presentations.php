<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use frontend\models\Activities;
use frontend\models\Offers;

/**
 * This is the model class for table "presentations".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $provider_service_id
 * @property integer $service_id 
 * @property integer $object_id 
 * @property integer $object_model_id 
 * @property string $provider_id
 * @property string $loc_id
 * @property string $name
 * @property string $description
 * @property string $amount
 * @property string $amount_operator
 * @property integer $consumer
 * @property string $consumer_operator
 * @property integer $consumer_children
 * @property integer $frequency
 * @property string $frequency_unit
 * @property integer $duration
 * @property string $duration_operator
 * @property integer $duration_unit
 * @property string $price
 * @property string $price_operator
 * @property integer $currency_id
 * @property integer $fixed_price
 * @property integer $warranty
 * @property string $note
 * @property integer $on_sale
 * @property string $available_from 
 * @property string $available_until 
 * @property string $status
 *
 * @property PresentationImages[] $presentationImages
 * @property PresentationIssues[] $presentationIssues
 * @property PresentationMethods[] $presentationMethods
 * @property PresentationSpecs[] $presentationSpecs
 * @property Activities $activity
 * @property Offers $offer
 * @property ProviderServices $providerService
 * @property Locations $loc
 * @property CsUnits $duration_unit
 * @property CsCurrencies $currency
 * @property Promotions[] $promotions
 */
class Presentations extends \yii\db\ActiveRecord
{
    public $service; // izabrana usluga
    public $object_models = [];
    public $imageFiles = [];
    public $issues = [];
    public $availability;
    public $location_input;

    public $provider_presentation_specs;
    public $provider_presentation_pics;
    public $provider_presentation_methods;

    private $_service;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id', 'price'], 'required'],
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'object_model_id', 'provider_id', 'loc_id', 'amount', 'consumer', 'consumer_children', 'frequency', 'duration', 'duration_unit', 'price', 'currency_id', 'fixed_price','consumer_price', 'warranty', 'availability', 'on_sale'], 'integer'],
            [['description', 'amount_operator', 'consumer_operator', 'frequency_unit', 'duration_operator', 'price_operator', 'price_per', 'note', 'status'], 'string'],
            [['available_from', 'available_until', 'availability'], 'safe'],
            //[['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 12, 'maxSize' => 1024*1024*20, 'tooMany'=>'Možete prikačiti najviše 8 fotografija.'],
            ['loc_id', 'required', 'when' => function ($model) {
                        return $model->location_input == '';
                    }, 'whenClient' => "function (attribute, value) {
                    return $('#presentation-location').val() == '';
            }"],
            [['location_operational'], 'string'],
            [['loc_within'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['object_models', 'update_time', 'imageFiles', 'issues', 'location_input'], 'safe'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            //[['loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loc_id' => 'id']],
            [['duration_unit'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['period_unit' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsCurrencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['update_time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
            ['consumer_price', 'default', 'value'=>0],
            ['fixed_price', 'default', 'value'=>1],
            [['provider_presentation_specs', 'provider_presentation_pics', 'provider_presentation_methods'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
           'activity_id' => Yii::t('app', 'Activity ID'),
           'offer_id' => Yii::t('app', 'Offer ID'),
           'provider_service_id' => Yii::t('app', 'Provider Service ID'),
           'service_id' => Yii::t('app', 'Service ID'),
           'object_id' => Yii::t('app', 'Object ID'),
           'object_model_id' => Yii::t('app', 'Object Model ID'),
           'provider_id' => Yii::t('app', 'Provider ID'),
           'loc_id' => Yii::t('app', 'Vaša sačuvana lokacija'),
           'location_operational' => Yii::t('app', 'Područje delovanja'),
           'loc_within' => Yii::t('app', 'U radijusu lokacije'),
           'name' => Yii::t('app', 'Naslov ponude'),
           'description' => Yii::t('app', 'Tesktualni opis ponude'),
           'amount' => Yii::t('app', 'Količina'),
           'amount_operator' => Yii::t('app', 'Amount Operator'),
           'consumer' => Yii::t('app', 'Broj korisnika'),
           'consumer_operator' => Yii::t('app', 'Consumer Operator'),
           'consumer_children' => Yii::t('app', 'Broj dece'),
           'frequency' => Yii::t('app', 'Učestalost'),
           'frequency_unit' => Yii::t('app', 'Jedinica mere'),
           'duration' => Yii::t('app', 'Trajanje'),
           'duration_operator' => Yii::t('app', 'Duration Operator'),
           'duration_unit' => Yii::t('app', 'Duration Unit'),
           'price' => Yii::t('app', 'Cena'),
           'price_operator' => Yii::t('app', 'Price Operator'),
           'currency_id' => Yii::t('app', 'Valuta'),
           'consumer_price' => Yii::t('app', 'Cena po osobi?'),
           'fixed_price' => Yii::t('app', 'Fiksna cena?'),
           'warranty' => Yii::t('app', 'Garancije'),
           'note' => Yii::t('app', 'Napomena'),
           'on_sale' => Yii::t('app', 'Na prodaju'),
           'availability' => Yii::t('app', 'Dostupnost'),
           'available_from' => Yii::t('app', 'Dostupnost'),
           'available_until' => Yii::t('app', 'Dostupno do'),
           'status' => Yii::t('app', 'Status'),
           'provider_presentation_specs' => Yii::t('app', 'Sačuvane ponude'),
           'provider_presentation_pics' => Yii::t('app', 'Sačuvane ponude'),
           'imageFiles' => Yii::t('app', 'Prikačite slike'),
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
                $imageName = Yii::$app->security->generateRandomString();
                $file->saveAs('images/presentations/' . $imageName . '1.' . $file->extension);
                $image[$key_f] = new \frontend\models\Images();
                $image[$key_f]->ime = $imageName . '.' . $file->extension;
                $image[$key_f]->type = 'image';
                $image[$key_f]->date = date('Y-m-d H:i:s');
                $thumb = '@webroot/images/presentations/'.$imageName.'1.'.$file->extension;
                Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('@webroot/images/presentations/'.$imageName.'.'.$file->extension), ['quality' => 80]);
                Image::thumbnail($thumb, 1920, 1200)->save(Yii::getAlias('@webroot/images/presentations/full/'.$imageName.'.'.$file->extension), ['quality' => 80]);
                Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('@webroot/images/presentations/thumbs/'.$imageName.'.'.$file->extension), ['quality' => 80]);
                if($image[$key_f]->save()){
                    $presentation_image[$key_f] = new \frontend\models\PresentationImages();
                    $presentation_image[$key_f]->presentation_id = $this->id;
                    $presentation_image[$key_f]->image_id = $image[$key_f]->id;
                    $presentation_image[$key_f]->save();
                }
                unlink(Yii::getAlias($thumb));
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getPService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getUser()
    {
        return $this->activity->user;
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getObjectModel()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_model_id']);
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getObjectModels()
    {
        return $this->hasMany(PresentationObjectModels::className(), ['object_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(PresentationImages::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssues()
    {
        return $this->hasMany(PresentationIssues::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(PresentationLocations::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMethods()
    {
        return $this->hasMany(PresentationMethods::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecs()
    {
        return $this->hasMany(PresentationSpecs::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offers::className(), ['id' => 'offer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderService()
    {
        return $this->hasOne(ProviderServices::className(), ['id' => 'provider_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDurationUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'period_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(CsCurrencies::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        return $this->hasMany(Promotions::className(), ['presentation_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        // user log
        $userLog = new \frontend\models\UserLog();
        $userLog->user_id = Yii::$app->user->id;
        $userLog->action = $insert ? 'presentation_created' : 'presentation_updated';
        $userLog->alias = $this->id;
        $userLog->time = date('Y-m-d H:i:s');
        $userLog->save();
        
        parent::afterSave($insert, $changedAttributes);     
    }


    public function checkIfMethods()
    {
        return ($this->service->serviceMethods) ? 0 : 1;
    }

    public function checkIfSpecs()
    {
        return ($this->service->serviceSpecs!=null or ($this->service->object->isPart() && $this->service->object->parent->specs)) ? 0 : 1;
    }

     public function checkIfIssues()
    {
        return ($this->service->service_type==6 && ($this->service->object->issues!=null or (count($this->object_models)==1 and $this->object_models[0]->issues))) ? 0 : 1;
    }

    public function checkIfLocation()
    {
        return ($this->service->location!=0) ? 0 : 1;
    }

    public function checkIfAmount()
    {
        return ($this->service->amount!=0 && $this->service->service_object!=1) ? 0 : 1;
    }

    public function checkIfConsumer()
    {
        return ($this->service->consumer!=0) ? 0 : 1;
    }

    public function checkIfAvailability()
    {
        return ($this->service->availability!=0) ? 0 : 1;
    }    

    public function getNoPic()
    {
        return 2-$this->checkIfSpecs();
    }

    public function getNoIssues()
    {
        return 3-$this->checkIfSpecs();
    }

    public function getNoMethods()
    {
        return 4-$this->checkIfSpecs()-$this->checkIfIssues();
    }

    public function getNoTitle()
    {
        return 5-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods();
    }

    public function getNoLocation()
    {
        return 6-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods();
    }

    public function getNoPrice()
    {
        return 7-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation();
    }

    public function getNoAmount()
    {
        return 8-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation();
    }

    public function getNoConsumer()
    {
        return 9-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount();
    }    

    public function getNoAvailability()
    {
        return 10-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer();
    }

    public function getNoOther()
    {
        return 11-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoNotifications()
    {
        return 12-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoTerms()
    {
        return 13-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoUac()
    {
        return 14-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function fotorama($options, $full=null)
    {
        if($this->images){
            foreach ($this->images as $media){
                $media_items[] = [
                    'img' => '../images/presentations/'.$full.$media->image->ime,
                    'thumb' => '../images/presentations/thumbs/'.$media->image->ime,
                    'full' => '../images/presentations/full/'.$media->image->ime, // Separate image for the fullscreen mode.
                    'fit' => 'cover',
                ]; 
            }
            return \metalguardian\fotorama\Fotorama::widget(
                [
                    'options' => $options,
                    'useHtmlData' => false,
                    'htmlOptions' => [
                        'style'=>'text-align:center; margin:0 auto;',
                        'class'=>'full-width-cover'
                    ],
                    'items' => $media_items,
                ]);
        }
        return null;            
    }

    public function coverPhotos()
    {
        $options = [
            'loop' => true,
            'hash' => true,
            'allowfullscreen' => 'native',
            'width' => '100%',
            'height' => '432',
            'maxheight' => '100%',
            'minwidth'=> '1380',
            'ratio' => 1920/432,
            'nav' => false,
            //'fit' => 'none',
        ];
        return $this->fotorama($options, 'full/');
    }

    public function photos()
    {
        $options = [
            'loop' => true,
            'hash' => true,
            'allowfullscreen' => true,
            'width' => '400',
            'height' => '300',
            //'ratio' => 4/3,
            'nav' => 'thumbs',
            'thumbwidth' => 80,
            'thumbheight' => 64,
            //'fit' => 'cover',
        ];
        return $this->fotorama($options);
    }

    public function generatedServiceName()
    {
        $objectM = null;
        if($objectModels = $this->objectModels){
            $objectM = count($objectModels)==1 ? $objectModels[0]->tNameGen : null;
        }
        $methodM = null;
        if($methodModels = $this->methods){
            $methodM = count($methodModels)==1 ? $methodModels[0]->value()->tName : null;
        }
        if($objectM == null && $methodM == null){            
            return $this->pService->tName;
        } else {
            $act = $this->pService->action->tName;
            if($methodM != null){
               $act .=  ' ['.$methodM.'] ';
            }
            $obj = $this->object->tNameGen;
            if($objectM != null){
               $obj .= ': '.$objectM;
            }
            return $act . $obj;
        }
    }

    public function locationOperatingModels()
    {
        $service = $this->service;
        $model_list = [];
        if($service){
            switch ($service->coverage) {
            case 0:
                $model_list = [];
                break;
            case 3:
                $model_list = [
                    'country'=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    'city'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    'exact'=>'Samo na navedenoj lokaciji: <b><span class="loc_op_exact"></span></b>',
                    'within'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            case 4:
                $model_list = [
                    'no_limit'=>'Bez ograničenja', 
                    'country'=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    'city'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    'exact'=>'Samo na navedenoj lokaciji: <b><span class="loc_op_exact"></span></b>',
                    'within'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            default:
                $model_list = [
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    'city'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    'exact'=>'Samo na navedenoj lokaciji: <b><span class="loc_op_exact"></span></b>',
                    'within'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
            }
        }
        return $model_list;
    }

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    public function allObjectSpecifications($service, $object_model)
    {
        //$object_model = $this->objectModels;
        //$service = $this->pService;
        if($object_model!=null || $service->serviceSpecs!=null) {
            if($service->serviceSpecs!=null){
               foreach($service->serviceSpecs as $serviceSpec) {
                    if($serviceSpec->spec) {
                        $objectSpecification[] = $serviceSpec->spec;
                    }           
                } 
            }
            if($service->object->isPart() && $service->object->parent->specs){
               foreach($this->service->object->parent->specs as $parentSpec) {
                    if($parentSpec) {
                        $objectSpecification[] = $parentSpec;
                    }           
                } 
            }
            if($object_model!=null && count($object_model)==1){
                if ($objectSpecs = $object_model[0]->specs) {
                    foreach($objectSpecs as $objectSpec) {
                        if(!in_array($objectSpec, $objectSpecification)){ 
                            $objectSpecification[] = $objectSpec;                               
                        }                                   
                    }
                }           
            }          
        } 
        return (isset($objectSpecification)) ? $objectSpecification : null;
    }

    public function checkUserObjectsExist($service, $object_model)
    {
        if(!Yii::$app->user->isGuest && $object_model && count($object_model)==1){
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
            if($user->userObjects){
                foreach ($user->userObjects as $userObject){
                    if($userObject->object_id==$service->object_id || $userObject->object_id==$object_model[0]->id){
                        $userObjects[] = $userObject;
                    }
                }
                return (isset($userObjects)) ? $userObjects : null;
            } else {
                return false;
            }            
        } else {
            return false;
        }        
    }  

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationSpecifications($service, $object_model)
    {
        if($objectSpecs = $this->allObjectSpecifications($service, $object_model)){
            foreach($objectSpecs as $objectSpec) {
                if($objectSpec->property) {
                    $property = $objectSpec->property;
                    $model_spec[$property->id] = new PresentationSpecs();
                    $model_spec[$property->id]->specification = $objectSpec;
                    $model_spec[$property->id]->property = $property;
                    $model_spec[$property->id]->service = $service;
                    $model_spec[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_model)) ? 0 : 1;
                }                                   
            }
            return (isset($model_spec)) ? $model_spec : null;
        }
        return null;        
    }

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationSpecificationsUpdate($model_specs)
    {
        if($model_specs){
            foreach($model_specs as $model_spec){
                $property = $model_spec->spec->property;
                $model_spec->specification = $model_spec->spec;
                $model_spec->property = $property;
                $model_spec->service = $this->pService;
                $model_spec->checkUserObject = ($this->checkUserObjectsExist($this->pService, $this->objectModel)) ? 0 : 1;
            }
            return $model_specs;
        }
        return null;        
    }

    public function loadPresentationMethods($service)
    {
        if($service->serviceMethods!=null) {
            foreach($service->serviceMethods as $serviceMethod) {
                if($serviceMethod->method) {
                    if($property = $serviceMethod->method->property) { 
                        $model_methods[$property->id] = new \frontend\models\PresentationMethods();
                        $model_methods[$property->id]->serviceMethod = $serviceMethod->method;
                        $model_methods[$property->id]->property = $property;
                        $model_methods[$property->id]->service = $service;
                    }
                }           
            }
            return (isset($model_methods)) ? $model_methods : null;
        }
        return null;
    }

    public function loadPresentationMethodsUpdate($model_methods)
    {
        if($model_methods) {
            foreach($model_methods as $model_method){
                $property = $model_method->method->property;
                $model_method->serviceMethod = $model_method->method;
                $model_method->property = $property;
                $model_method->service = $this->pService;
            }
            return $model_methods;
        }
        return null;
    }
}
