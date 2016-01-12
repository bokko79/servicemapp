<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_services".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $provider_id
 * @property integer $service_id
 * @property integer $industry_id
 * @property string $loc_id
 * @property string $name
 * @property string $description
 * @property integer $period
 * @property integer $period_unit
 * @property string $price
 * @property string $price_max
 * @property integer $currency_id
 * @property integer $fixed_price
 * @property integer $warranty
 * @property string $note
 * @property integer $on_sale
 * @property integer $is_set
 * @property string $update_time
 *
 * @property OrderServices[] $orderServices
 * @property PromotionServices[] $promotionServices
 * @property ProviderServiceImages[] $providerServiceImages
 * @property ProviderServiceMethods[] $providerServiceMethods
 * @property ProviderServiceSpecs[] $providerServiceSpecs
 * @property ProviderServiceTerms $providerServiceTerms
 * @property Provider $provider
 * @property CsServices $service
 * @property CsUnits $periodUnit
 * @property CsCurrencies $currency
 * @property Locations $loc
 * @property Presentations $presentation
 * @property CsIndustries $industry
 */
class ProviderServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'provider_id', 'service_id', 'industry_id', 'update_time'], 'required'],
            [['presentation_id', 'provider_id', 'service_id', 'industry_id', 'loc_id', 'period', 'period_unit', 'price', 'price_max', 'currency_id', 'fixed_price', 'warranty', 'on_sale', 'is_set'], 'integer'],
            [['description', 'note'], 'string'],
            [['update_time'], 'safe'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'presentation_id' => 'Presentation ID',
            'provider_id' => 'Pružalac usluge.',
            'service_id' => 'Usluga kojom se pružalac usluge bavi.',
            'industry_id' => 'Delatnost usluge.',
            'loc_id' => 'Lokacija na kojoj pružalac usluge izvršava uslugu.',
            'name' => 'Ime usluge (ako ima više sličnih npr. izdavanje soba, ime svake sobe).',
            'description' => 'Opis načina izvršenja usluge.',
            'period' => 'Vreme za koje se usluga uobičajeno izvršava.',
            'period_unit' => 'Jedinica vremena u kojoj se izražava uobičajeno vreme izvršenja usluge.',
            'price' => 'Uobičajena cena izvršenja usluge po jedinici mere.',
            'price_max' => 'Gornja cena.',
            'currency_id' => 'Valuta u kojoj je izražena cena izvršenja usluge iz kolone price.',
            'fixed_price' => 'Promenljivost cene izvršenja usluge. 0 - cena se može promeniti; 1 - cena je fiksna.',
            'warranty' => 'Garancije pružaoca usluge na izvršenu uslugu. 0 - ne; 1 - da.',
            'note' => 'Napomena na izvršenje usluge.',
            'on_sale' => 'Usluga je na prodaju za M-Credit. 0 - ne; 1 - da.',
            'is_set' => 'Usluga je podešena. 0 - ne; 1 - da.',
            'update_time' => 'Datum i vreme izmene usluge.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceImages()
    {
        return $this->hasMany(ProviderServiceImages::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceMethods()
    {
        return $this->hasMany(ProviderServiceMethods::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceSpecs()
    {
        return $this->hasMany(ProviderServiceSpecs::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceTerms()
    {
        return $this->hasOne(ProviderServiceTerms::className(), ['provider_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodUnit()
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
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @inheritdoc
     * @return ProviderServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderServicesQuery(get_called_class());
    }
}
