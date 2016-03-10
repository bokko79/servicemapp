<?php

namespace frontend\models;

use Yii;

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
            ['service', 'required'],
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'provider_id'], 'required'],
            [['activity_id', 'offer_id', 'provider_service_id', 'service_id', 'object_id', 'object_model_id', 'provider_id', 'loc_id', 'amount', 'consumer', 'consumer_children', 'frequency', 'duration', 'duration_unit', 'price', 'currency_id', 'fixed_price', 'warranty', 'on_sale'], 'integer'],
            [['description', 'amount_operator', 'consumer_operator', 'frequency_unit', 'duration_operator', 'price_operator', 'note', 'status'], 'string'],
            [['available_from', 'available_until'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['object_models'], 'safe'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            [['loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loc_id' => 'id']],
            [['duration_unit'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['period_unit' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsCurrencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
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
           'loc_id' => Yii::t('app', 'Loc ID'),
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
           'fixed_price' => Yii::t('app', 'Fiksna cena?'),
           'warranty' => Yii::t('app', 'Garancije'),
           'note' => Yii::t('app', 'Napomena'),
           'on_sale' => Yii::t('app', 'Na prodaju'),
           'available_from' => Yii::t('app', 'Dostupno od'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationImages()
    {
        return $this->hasMany(PresentationImages::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationIssues()
    {
        return $this->hasMany(PresentationIssues::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationLocations()
    {
        return $this->hasMany(PresentationLocations::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationMethods()
    {
        return $this->hasMany(PresentationMethods::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationSpecs()
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
}
