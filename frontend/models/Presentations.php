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
 * @property string $provider_id
 * @property string $youtube_link
 * @property string $title
 * @property string $description
 * @property string $loc_id
 * @property integer $loc_to_id
 * @property string $coverage
 * @property string $coverage_within
 * @property string $price
 * @property string $price_per
 * @property integer $price_unit
 * @property string $price_operator
 * @property integer $currency_id
 * @property integer $fixed_price
 * @property integer $consumer_price
 * @property integer $qtyPriceConst 
 * @property integer $qtyMin 
 * @property string $qtyMin_price 
 * @property string $qtyMax 
 * @property integer $qtyMax_percent 
 * @property integer $consumerPriceConst 
 * @property integer $consumerMin 
 * @property string $consumerMin_price 
 * @property string $consumerMax 
 * @property integer $consumerMax_percent 
 * @property integer $quantity_constraint
 * @property string $quantity_min
 * @property string $quantity_max
 * @property integer $consumer_constraint
 * @property integer $consumer_min
 * @property integer $consumer_max
 * @property string $valid_for_consumers
 * @property string $time_availability
 * @property integer $item_availability
 * @property integer $item_count
 * @property string $validity
 * @property string $valid_from
 * @property string $valid_through
 * @property integer $duration
 * @property string $duration_operator
 * @property integer $duration_unit
 * @property integer $warranty
 * @property string $request_type 
 * @property integer $delivery_delay 
 * @property string $delivery_delay_unit 
 * @property string $note
 * @property integer $on_sale 
 * @property string $status
 * @property string $update_time 
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
    public $location_from;
    public $location_to;
    public $location_hq;

    public $qtyConstMin;
    public $qtyConstMax;
    public $conumerConstMin;
    public $conumerConstMax;

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
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id'], 'required'],
           [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id', 'loc_id', 'loc_to_id', 'price_unit', 'currency_id', 'fixed_price', 'consumer_price', 'qtyPriceConst', 'qtyMin', 'qtyMax', 'qtyMax_percent', 'consumerPriceConst', 'consumerMin', 'consumerMax', 'consumerMax_percent', 'quantity_constraint', 'quantity_min', 'quantity_max', 'consumer_constraint', 'consumer_min', 'consumer_max', 'item_availability', 'item_count', 'duration', 'duration_unit', 'warranty', 'delivery_delay', 'on_sale'], 'integer'],
           [['description', 'coverage', 'price_per', 'price_operator', 'time_availability', 'validity', 'duration_operator', 'request_type', 'delivery_delay_unit', 'note', 'status'], 'string'],
           [['coverage_within', 'price', 'qtyMin_price', 'consumerMin_price'], 'number'],
           [['valid_from', 'valid_through', 'update_time'], 'safe'],
           [['youtube_link'], 'string', 'max' => 128],
           [['title', 'valid_for_consumers'], 'string', 'max' => 64],
           [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
           [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
           [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            //[['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 12, 'maxSize' => 1024*1024*20, 'tooMany'=>'Možete prikačiti najviše 8 fotografija.'],
            ['loc_id', 'required', 'when' => function ($model) {
                        return $model->location_input == '';
                    }, 'whenClient' => "function (attribute, value) {
                    return $('#presentation-location').val() == '';
            }"],
            [['imageFiles', 'issues', 'location_input'], 'safe'],
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
           'youtube_link' => Yii::t('app', 'Youtube Link'),
           'loc_id' => Yii::t('app', 'Vaša sačuvana lokacija'),   
           'loc_to_id' => Yii::t('app', 'Loc To ID'),           
           'coverage' => Yii::t('app', 'Područje pokrivenosti'),
           'coverage_within' => Yii::t('app', 'U radijusu lokacije'),
           'title' => Yii::t('app', 'Naslov ponude'),
           'description' => Yii::t('app', 'Tesktualni opis ponude'),           
           'duration' => Yii::t('app', 'Trajanje'),
           'duration_operator' => Yii::t('app', 'Duration Operator'),
           'duration_unit' => Yii::t('app', 'Duration Unit'),
           'price' => Yii::t('app', 'Cena'),
           'price_operator' => Yii::t('app', 'Price Operator'),
           'price_unit' => Yii::t('app', 'Price Unit'),
           'currency_id' => Yii::t('app', 'Valuta'),
           'consumer_price' => Yii::t('app', 'Cena po osobi?'),
           'fixed_price' => Yii::t('app', 'Fiksna cena?'),
           'qtyPriceConst' => Yii::t('app', 'Korekcije cene za naručene količine?'),
           'qtyMin' => Yii::t('app', 'Qty Min'),
           'qtyMin_price' => Yii::t('app', 'Qty Min Price'),
           'qtyMax' => Yii::t('app', 'Qty Max'),
           'qtyMax_percent' => Yii::t('app', 'Qty Max Percent'),
           'consumerPriceConst' => Yii::t('app', 'Korekcije cene za broj korisnika?'),
           'consumerMin' => Yii::t('app', 'Consumer Min'),
           'consumerMin_price' => Yii::t('app', 'Consumer Min Price'),
           'consumerMax' => Yii::t('app', 'Consumer Max'),
           'consumerMax_percent' => Yii::t('app', 'Consumer Max Percent'),
           'quantity_constraint' => Yii::t('app', 'Korekcije cene za naručene količine?'),
           'quantity_min' => Yii::t('app', 'Quantity Min'),
           'quantity_max' => Yii::t('app', 'Quantity Max'),
           'consumer_constraint' => Yii::t('app', 'Korekcije cene za broj korisnika?'),
           'consumer_min' => Yii::t('app', 'Consumer Min'),
           'consumer_max' => Yii::t('app', 'Consumer Max'),
           'valid_for_consumers' => Yii::t('app', 'Valid For Consumers'),
           'time_availability' => Yii::t('app', 'Time Availability'),
           'item_availability' => Yii::t('app', 'Item Availability'),
           'item_count' => Yii::t('app', 'Item Count'),
           'validity' => Yii::t('app', 'Validity'),
           'valid_from' => Yii::t('app', 'Valid From'),
           'valid_through' => Yii::t('app', 'Valid Through'),
           'warranty' => Yii::t('app', 'Warranty'),
           'request_type' => Yii::t('app', 'Request Type'),
           'delivery_delay' => Yii::t('app', 'Delivery Delay'),
           'delivery_delay_unit' => Yii::t('app', 'Delivery Delay Unit'),           
           'update_time' => Yii::t('app', 'Update Time'),
           'note' => Yii::t('app', 'Napomena'),
           'on_sale' => Yii::t('app', 'Na prodaju'),
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
    public function getMethods()
    {
        return $this->hasMany(PresentationMethods::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasOne(PresentationNotifications::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricings()
    {
        return $this->hasMany(PresentationPricings::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetables()
    {
        return $this->hasMany(PresentationTimetables::className(), ['presentation_id' => 'id']);
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
    public function getTerms()
    {
        return $this->hasOne(PresentationTerms::className(), ['presentation_id' => 'id']);
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

    public function checkIfNotif()
    {
        return (Yii::$app->controller->action=='update') ? 0 : 2;
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
        return 14-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability()-$this->checkIfNotif();
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
        // 0-within
        // 1-HQ
        // 2-City (up to 20km)
        // 3-Region (up to 200)
        // 4-Country (up to 500 km)
        // 5-Wide (up to 1000km)
        // 6-Worldwide
        $service = $this->service;
        $model_list = [];
        if($service){
            switch ($service->coverage) {
            case 0:
                $model_list = [];
                break;
            case 3:
                $model_list = [
                    '5'=>'<b><span class="loc_op_country"></span></b> i šire', 
                    '4'=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    '2'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    '1'=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    '0'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            case 4:
                $model_list = [
                    '6'=>'Bez ograničenja (ceo svet/nebitno)', 
                    '5'=>'<b><span class="loc_op_country"></span></b> i šire',
                    '4'=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    '2'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    '1'=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    '0'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            default:
                $model_list = [
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    '2'=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    '1'=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    '0'=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
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

    public function hasProviderLocations()
    {
        if(!Yii::$app->user->isGuest and $user = \frontend\models\User::findOne(Yii::$app->user->id) and $user->provider and $proLocations = $user->provider->locations) {            
            return $proLocations;
        }
        return null;
    }
}
