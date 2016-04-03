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
    //public $files = [];
    public $issues = [];
    public $availability;
    public $location_input;
    public $location_from;
    public $location_to;
    public $location_hq;
    public $location_control;
    public $location_userControl;

    public $qtyConstMin;
    public $qtyConstMax;
    public $conumerConstMin;
    public $conumerConstMax;

    public $quantityConstCheck;
    public $consumerConstCheck;

    public $provider_presentation_specs;
    public $provider_presentation_pics;
    public $provider_presentation_docs;
    public $provider_presentation_methods;

    public $calculated_Price;

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
           [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id', 'loc_id', 'loc_to_id', 'price_unit', 'currency_id', 'fixed_price', 'consumer_price', 'qtyPriceConst', 'qtyMin', 'qtyMax', 'qtyMax_percent', 'consumerPriceConst', 'consumerMin', 'consumerMax', 'consumerMax_percent', 'availabilityPriceConst', 'availability_percent', 'quantity_constraint', 'quantity_min', 'quantity_max', 'consumer_constraint', 'consumer_min', 'consumer_max', 'item_availability', 'item_count', 'duration', 'duration_unit', 'warranty', 'delivery_delay', 'on_sale'], 'integer'],
           [['description', 'coverage', 'price_per', 'price_operator', 'time_availability', 'validity', 'duration_operator', 'request_type', 'delivery_delay_unit', 'note', 'status'], 'string'],
           [['coverage_within', 'qtyMin_price', 'consumerMin_price'], 'number'],
           [['price'], 'number', 'min'=>0],
           [['price'], 'required'],
           [['valid_from', 'valid_through', 'update_time', 'calculated_Price'], 'safe'],
           [['youtube_link'], 'string', 'max' => 256],
           [['youtube_link'], 'url', 'pattern'=>'/^https:\/\/(?:www\.)?(?:youtube.com|youtu.be)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/'],
           [['title', 'valid_for_consumers'], 'string', 'max' => 64],
           [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
           [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
           [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, pdf', 'maxFiles' => 12, 'maxSize' => 1024*1024*20, 'tooMany'=>'Možete prikačiti najviše 8 fotografija.'],
            //[ 'files', 'file', 'extensions' => ['pdf'], 'wrongExtension' => 'Samo PDF datoteke su dopuštene za {attribute}.', 'wrongMimeType' => 'Samo PDF datoteke su dopuštene za {attribute}.', 'skipOnEmpty'=>true, 'mimeTypes'=>['application/pdf']],
            ['loc_id', 'required', 'when' => function ($model) {
                        return $model->location_input == '';
                    }, 'whenClient' => "function (attribute, value) {
                    return $('#presentation-location').val() == '';
            }"],
            [['imageFiles', 'issues', 'location_input'], 'safe'],
            //[['loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loc_id' => 'id']],
            [['duration_unit'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['duration_unit' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsCurrencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['update_time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
            ['consumer_price', 'default', 'value'=>0],
            ['fixed_price', 'default', 'value'=>1],
            [['provider_presentation_specs', 'provider_presentation_pics', 'provider_presentation_docs', 'provider_presentation_methods'], 'safe'],
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
           'availabilityPriceConst' => Yii::t('app', 'Korekcije cene za dostupnost?'),
           'availability_percent' => Yii::t('app', 'Korekcija cene ukoliko niste dostupni'),
           'quantity_constraint' => Yii::t('app', 'Korekcije cene za naručene količine?'),
           'quantity_min' => Yii::t('app', 'Quantity Min'),
           'quantity_max' => Yii::t('app', 'Quantity Max'),
           'consumer_constraint' => Yii::t('app', 'Korekcije cene za broj korisnika?'),
           'consumer_min' => Yii::t('app', 'Consumer Min'),
           'consumer_max' => Yii::t('app', 'Consumer Max'),
           'valid_for_consumers' => Yii::t('app', 'Valid For Consumers'),
           'time_availability' => Yii::t('app', 'Dostupnost za vršenje usluge'),
           'item_availability' => Yii::t('app', 'Item Availability'),
           'item_count' => Yii::t('app', 'Item Count'),
           'validity' => Yii::t('app', 'Ponuda važi'),
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
           'provider_presentation_pics' => Yii::t('app', 'Sačuvane slike'),
           'provider_presentation_docs' => Yii::t('app', 'Sačuvani dokumenti'),
           'provider_presentation_methods' => Yii::t('app', 'Sačuvane ponude'),
           'imageFiles' => Yii::t('app', 'Prikačite slike i/ili PDF'),
           'files' => Yii::t('app', 'Prikačite PDF dokumente'),
           'location_input' => Yii::t('app', 'Adresa Vašeg sedišta'),
           'quantityConstCheck' => Yii::t('app', 'Ograničenja na naručene količine?'),
           'consumerConstCheck' => Yii::t('app', 'Ograničenja na broj korisnika?'),
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getService()
    {
        if($this->pService){
            $this->_service = $this->pService;
        }
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
                    $file->saveAs('images/presentations/docs/' . $fileName . '.' . $file->extension);
                } else {
                    $file->saveAs('images/presentations/' . $fileName . '1.' . $file->extension);
                }
                
                $image[$key_f] = new \frontend\models\Images();
                $image[$key_f]->ime = $fileName . '.' . $file->extension;
                $image[$key_f]->type = $file->extension=='pdf' ? 'pdf' : 'image';
                $image[$key_f]->date = date('Y-m-d H:i:s');
                if($file->extension!='pdf'){
                   $thumb = '@webroot/images/presentations/'.$fileName.'1.'.$file->extension;
                    Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('@webroot/images/presentations/'.$fileName.'.'.$file->extension), ['quality' => 80]);
                    Image::thumbnail($thumb, 1920, 1200)->save(Yii::getAlias('@webroot/images/presentations/full/'.$fileName.'.'.$file->extension), ['quality' => 80]);
                    Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('@webroot/images/presentations/thumbs/'.$fileName.'.'.$file->extension), ['quality' => 80]); 
                }                    
                if($image[$key_f]->save()){
                    $presentation_image[$key_f] = new \frontend\models\PresentationImages();
                    $presentation_image[$key_f]->presentation_id = $this->id;
                    $presentation_image[$key_f]->image_id = $image[$key_f]->id;
                    $presentation_image[$key_f]->type = $image[$key_f]->type;
                    $presentation_image[$key_f]->save();
                }
                if($file->extension!='pdf'){
                    unlink(Yii::getAlias($thumb));
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /*public function uploadFiles()
    {
        if ($this->validate()) { 
            foreach ($this->files as $key_f=>$file) {
                $fileName = Yii::$app->security->generateRandomString();
                //$this->save();
                $file->saveAs('images/presentations/docs/' . $fileName . '.' . $file->extension);
                $doc[$key_f] = new \frontend\models\Images();
                $doc[$key_f]->ime = $fileName . '.' . $file->extension;
                $doc[$key_f]->type = 'pdf';
                $doc[$key_f]->date = date('Y-m-d H:i:s');              
                if($doc[$key_f]->save()){
                    $presentation_image[$key_f] = new \frontend\models\PresentationImages();
                    $presentation_image[$key_f]->presentation_id = $this->id;
                    $presentation_image[$key_f]->image_id = $doc[$key_f]->id;
                    $presentation_image[$key_f]->save();
                }                   
            }
            return true;
        } else {
            return false;
        }
    }*/

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
    public function getObjectModels()
    {
        return $this->hasMany(PresentationObjectModels::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(PresentationImages::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {   
        $images = [];     
        if($documents = $this->documents)
        {
            foreach($documents as $document){
                if($document->image->type=='image'){
                    $images[] = $document->image;
                }
            }
        }
        return $images;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdfs()
    {   
        $pdf = [];     
        if($documents = $this->documents)
        {
            foreach($documents as $document){
                if($document->image->type=='pdf'){
                    $pdf[] = $document->image;
                }
            }
        }
        return $pdf;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
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

    public function getMethodModels() 
    {
        return $this->hasMany(PresentationMethodModels::className(), ['presentation_method_id' => 'id'])
          ->viaTable('presentation_methods', ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasOne(PresentationNotifications::className(), ['presentation_id' => 'id']);
    }

    /**
     * Service to be added to cart
     *
     * @return CsService|null
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
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

    public function getSpecModels() 
    {
        return $this->hasMany(PresentationSpecModels::className(), ['presentation_spec_id' => 'id'])
          ->viaTable('presentation_specs', ['presentation_id' => 'id']);
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
    public function getLocation()
    {
        return $this->hasOne(LocationPresentation::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationTo()
    {
        return $this->hasOne(LocationPresentationTo::className(), ['id' => 'loc_to_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationHQ()
    {
        return $this->user->provider->location;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDurationUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'duration_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'price_unit']);
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

    public function fotorama($options, $full=null)
    {
        if($this->images){
            foreach ($this->images as $media){
                $media_items[] = [
                    'img' => '../images/presentations/'.$full.$media->ime,
                    'thumb' => '../images/presentations/thumbs/'.$media->ime,
                    'full' => '../images/presentations/full/'.$media->ime, // Separate image for the fullscreen mode.
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
            $objectM = count($objectModels)==1 ? $objectModels[0]->object->tNameGen : null;
        }
        $methodM = null;
        if($methodModels = $this->methods){
            $methodM = null;
            foreach($methodModels as $methodModel){
                if($methodModel->method->type=='types'){
                   $methodM = ($methodModel->models) ? $methodModel->models[0]->model->tname : null; 
                   break;
                }
            }
        }
        if($objectM == null && $methodM == null){            
            return ($this->pService) ? $this->pService->tName : $this->service->tName;
        } else {
            $act = ($this->pService) ? $this->pService->action->tName : $this->service->action->tName;
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

    public function hasProviderLocation()
    {
        if(!Yii::$app->user->isGuest and $user = \frontend\models\User::findOne(Yii::$app->user->id) and $user->provider and $proLocation = $user->provider->location) {            
            return $proLocation;
        }
        return null;
    }

    public function validityStatus()
    {
        if($this->validity){
            switch ($this->validity) {
                case 'yes':
                    echo '<i class="fa fa-check"></i> Dostupno';
                    break;
                case 'limited':
                    echo '<b>Dostupno od '.Yii::$app->formatter->asDate($this->valid_from).' do '.Yii::$app->formatter->asDate($this->valid_through).'</b>';
                    break;
                default:
                    echo '<i class="fa fa-ban"></i> Ova usluga trenutno nije dostupna';
                    break;
            } 
        }                    
    }

    public function calculatedPrice($quantity=null, $consumer=null, $availability=false)
    {
        $price = $this->price;
        if((($this->qtyMin_price and $this->qtyMin) or ($this->qtyMax_percent and $this->qtyMax)) and $quantity!=null and $quantity!=''){
          if($quantity < $this->qtyMin){
            return  $this->qtyMin_price;
          } else if($quantity > $this->qtyMax) {
            return round($price*(100-$this->qtyMax_percent)/100, 2);
          }          
        }
        if((($this->consumerMin_price and $this->consumerMin) or ($this->consumerMax_percent and $this->consumerMax)) and $consumer!=null and $consumer!=''){
          if($consumer < $this->consumerMin){
            return  $this->consumerMin_price;
          } else if($consumer > $this->consumerMax) {
            return round($price*(100-$this->consumerMax_percent)/100, 2);
          }
        }        
        if($this->availability_percent!=null and $this->availabilityPriceConst==1 and $availability!=null){
          return ($availability) ? round($price*(100+$this->availability_percent)/100, 2) : $price;
        }

        return $price;
    }
}
