<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bids".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $order_id
 * @property string $loc_id
 * @property integer $period
 * @property integer $period_unit
 * @property string $delivery_starts
 * @property string $price
 * @property integer $currency_id
 * @property string $price_per
 * @property string $price_per_unit
 * @property integer $fixed_price
 * @property integer $warranty
 * @property string $note
 * @property string $spec
 * @property string $reject_reason
 * @property string $report_reason
 * @property string $time
 * @property integer $hit_counter
 *
 * @property BidTerms $bidTerms
 * @property Orders $order
 * @property CsCurrencies $currency
 * @property CsUnits $periodUnit
 * @property Locations $loc
 * @property Activities $activity
 * @property Offers $offer
 */
class Bids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'order_id', 'price', 'price_per_unit', 'time'], 'required'],
            [['activity_id', 'offer_id', 'order_id', 'loc_id', 'period', 'period_unit', 'currency_id', 'fixed_price', 'warranty', 'hit_counter'], 'integer'],
            [['delivery_starts', 'time'], 'safe'],
            [['price', 'price_per_unit'], 'number'],
            [['price_per', 'note', 'spec'], 'string'],
            [['reject_reason', 'report_reason'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Stavka.',
            'offer_id' => 'ID ponude.',
            'order_id' => 'Usluga za koju se nude uslovi.',
            'loc_id' => 'Lokacija ponuđača na kojoj će se izvršiti usluga.',
            'period' => 'Vreme za koje će usluga biti izvršena.',
            'period_unit' => 'Jedinica vremena u kojoj se računa potrebno vreme za izvršenje usluge.',
            'delivery_starts' => 'Datum početka izvršenja usluge.',
            'price' => 'Ponuđena cena koštanja izvršenja usluge.',
            'currency_id' => 'Valuta u kojoj se izražava ponuđena cena.',
            'price_per' => 'Obračunavanje cene. 1 - ukupno (TOTAL); 2 - po jedinici mere; 3 - opciono.',
            'price_per_unit' => 'Jedinična cena.',
            'fixed_price' => 'Cena je nepromenljiva. 0 - ne; 1 - da, fiksna cena.',
            'warranty' => 'Garancije ponuđača na izvršenje usluge.',
            'note' => 'Napomena ponuđača.',
            'spec' => 'Pomoćna kolona.',
            'reject_reason' => 'Razglog odbacivanja ponude.',
            'report_reason' => 'Razlog prijavljivanja ponude.',
            'time' => 'Datum i vreme ponude.',
            'hit_counter' => 'Broj pregleda ponude.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidTerms()
    {
        return $this->hasOne(BidTerms::className(), ['bid_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
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
    public function getPeriodUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'period_unit']);
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
     * @inheritdoc
     * @return BidsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BidsQuery(get_called_class());
    }
}
