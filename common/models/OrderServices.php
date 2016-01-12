<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_services".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $order_id
 * @property integer $service_id
 * @property string $provider_service_id
 * @property string $qty
 * @property integer $consumer
 * @property integer $frequency
 * @property string $frequency_unit
 * @property string $issue_text
 * @property string $note
 * @property string $rec_price
 * @property integer $currency_id
 * @property integer $turnkey
 * @property integer $support
 * @property string $description
 *
 * @property OrderServiceImages[] $orderServiceImages
 * @property OrderServiceIssues[] $orderServiceIssues
 * @property OrderServiceMethods[] $orderServiceMethods
 * @property OrderServiceSpecs[] $orderServiceSpecs
 * @property CsServices $service
 * @property CsCurrencies $currency
 * @property ProviderServices $providerService
 * @property Activities $activity
 * @property Orders $order
 */
class OrderServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'order_id', 'service_id', 'support'], 'required'],
            [['activity_id', 'order_id', 'service_id', 'provider_service_id', 'qty', 'consumer', 'frequency', 'rec_price', 'currency_id', 'turnkey', 'support'], 'integer'],
            [['frequency_unit', 'issue_text', 'note', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Zahtev za uslugu.',
            'order_id' => 'Projekat zahteva za uslugu.',
            'service_id' => 'Usluga.',
            'provider_service_id' => 'Provider Service ID',
            'qty' => 'Obim usluge.',
            'consumer' => 'Broj korisnika usluge.',
            'frequency' => 'Učestalost izvršenja usluge. (npr 2x mesečno).',
            'frequency_unit' => 'Jedinica vremena u kojoj se računa učestalost. daily - dnevno; weekly - sedmično; monthly - mesečno; yearly - godišnje.',
            'issue_text' => 'Tekstualno objašnjenje korisnika o problemu sa predmetom usluge.',
            'note' => 'Napomena na uslugu.',
            'rec_price' => 'Preporučena cena za uslugu.',
            'currency_id' => 'Valuta u kojoj se daju ponude.',
            'turnkey' => 'Ključ u ruke. 0 - Samo usluga; 1 - Usluga + materijal.',
            'support' => 'Podrška pružaoca usluge nakon izvršenja usluge. 0 - nepotrebna; 1 - potrebna.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceImages()
    {
        return $this->hasMany(OrderServiceImages::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceIssues()
    {
        return $this->hasMany(OrderServiceIssues::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceMethods()
    {
        return $this->hasMany(OrderServiceMethods::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceSpecs()
    {
        return $this->hasMany(OrderServiceSpecs::className(), ['order_service_id' => 'id']);
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
    public function getCurrency()
    {
        return $this->hasOne(CsCurrencies::className(), ['id' => 'currency_id']);
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
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @inheritdoc
     * @return OrderServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderServicesQuery(get_called_class());
    }
}
