<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'offer_id' => Yii::t('app', 'Offer ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'loc_id' => Yii::t('app', 'Loc ID'),
            'period' => Yii::t('app', 'Period'),
            'period_unit' => Yii::t('app', 'Period Unit'),
            'delivery_starts' => Yii::t('app', 'Delivery Starts'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'price_per' => Yii::t('app', 'Price Per'),
            'price_per_unit' => Yii::t('app', 'Price Per Unit'),
            'fixed_price' => Yii::t('app', 'Fixed Price'),
            'warranty' => Yii::t('app', 'Warranty'),
            'note' => Yii::t('app', 'Note'),
            'spec' => Yii::t('app', 'Spec'),
            'reject_reason' => Yii::t('app', 'Reject Reason'),
            'report_reason' => Yii::t('app', 'Report Reason'),
            'time' => Yii::t('app', 'Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->activity->user;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->id == $this->user->id) {
                return 'bidder';
            } elseif(Yii::$app->user->id == $this->order->user->id) {
                return 'sender';
            } else {
                return 'guest';
            }
        } else {
            return 'guest';
        }        
    }
}
