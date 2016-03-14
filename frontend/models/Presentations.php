<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

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
    public $availability;

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
        $service = $this->service;
        $pic = ($service->pic==1) ? [['imageFiles'], 'file', 'skipOnEmpty' => false, /*'extensions' => 'png, jpg, jpeg, gif', */'maxFiles' => 8, 'tooMany'=>'Možete prikačiti najviše 8 fotografija.'] : ['imageFiles', 'safe'];

        return [
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id', 'price'], 'required'],
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'object_model_id', 'provider_id', 'loc_id', 'loc_within', 'amount', 'consumer', 'consumer_children', 'frequency', 'duration', 'duration_unit', 'price', 'currency_id', 'fixed_price','consumer_price', 'warranty', 'availability', 'on_sale'], 'integer'],
            [['description', 'amount_operator', 'consumer_operator', 'frequency_unit', 'duration_operator', 'price_operator', 'price_per', 'note', 'status'], 'string'],
            [['available_from', 'available_until', 'availability'], 'safe'],
            $pic,
            [['name'], 'string', 'max' => 64],
            [['object_models', 'update_time'], 'safe'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            [['loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loc_id' => 'id']],
            [['duration_unit'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['period_unit' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsCurrencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['update_time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
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
           'loc_within' => Yii::t('app', 'U radijusu lokacije'),
           'name' => Yii::t('app', 'Ime'),
           'description' => Yii::t('app', 'Opis'),
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
                $file->saveAs('images/presentations/' . $imageName . '.' . $file->extension);
                $image[$key_f] = new \frontend\models\Images();
                $image[$key_f]->ime = $imageName . '.' . $file->extension;
                $image[$key_f]->type = 'image';
                $image[$key_f]->date = date('Y-m-d H:i:s');
                //$thumb = Yii::$app->basePath.'/images/presentations/full/'.$imageName.'.'.$file->extension;
                //Image::thumbnail($thumb, 400, 300)->save(Yii::$app->basePath.'/images/presentations/', ['quality' => 80]);
                //Image::thumbnail($thumb, 1920, 1200)->save('images/presentations/full/', ['quality' => 80]);
                //Image::thumbnail($thumb, 80, 64)->save(Yii::$app->basePath.'/images/presentations/thumbs/', ['quality' => 80]);
                if($image[$key_f]->save()){
                    $presentation_image[$key_f] = new \frontend\models\PresentationImages();
                    $presentation_image[$key_f]->presentation_id = $this->id;
                    $presentation_image[$key_f]->image_id = $image[$key_f]->id;
                    $presentation_image[$key_f]->save();
                }
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

    public function checkIfMethods()
    {
        return ($this->service->serviceMethods) ? 0 : 1;
    }

    public function checkIfSpecs()
    {
        return ($this->service->serviceSpecs!=null) ? 0 : 1;
    }

     public function checkIfIssues()
    {
        return ($this->service->service_type==3 && $this->service->object->issues!=null) ? 0 : 1;
    }

    public function checkIfLocation()
    {
        return ($this->service->location!=0) ? 0 : 1;
    }

    public function checkIfAmount()
    {
        return ($this->service->amount!=0) ? 0 : 1;
    }

    public function checkIfConsumer()
    {
        return ($this->service->consumer!=0) ? 0 : 1;
    }

    public function checkIfAvailability()
    {
        return ($this->service->availability!=0) ? 0 : 1;
    }

    public function getNoSpecs()
    {
        return 2-$this->checkIfMethods();
    }

    public function getNoPic()
    {
        return 3-$this->checkIfMethods()-$this->checkIfSpecs();
    }

    public function getNoIssues()
    {
        return 4-$this->checkIfMethods()-$this->checkIfSpecs();
    }

    public function getNoTitle()
    {
        return 5-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues();
    }

    public function getNoLocation()
    {
        return 6-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues();
    }

    public function getNoAmount()
    {
        return 7-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation();
    }

    public function getNoConsumer()
    {
        return 8-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation()-$this->checkIfAmount();
    }

    public function getNoPrice()
    {
        return 9-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer();
    }

    public function getNoAvailability()
    {
        return 10-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer();
    }

    public function getNoOther()
    {
        return 11-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoUac()
    {
        return 12-$this->checkIfMethods()-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }
}
