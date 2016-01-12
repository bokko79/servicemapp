<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $presentation_id
 * @property string $title
 * @property string $subtitle
 * @property string $promo_text
 * @property string $old_price
 * @property string $new_price
 * @property integer $currency_id
 * @property integer $discount
 * @property integer $voucher
 * @property integer $max_subscribers
 * @property integer $scheduling
 * @property string $not_valid_for
 * @property string $active_from
 * @property string $validity
 * @property string $time
 * @property string $description
 *
 * @property PromotionImages[] $promotionImages
 * @property PromotionServices[] $promotionServices
 * @property CsCurrencies $currency
 * @property Activities $activity
 * @property Offers $offer
 * @property Presentations $presentation
 * @property UserOrder[] $userOrders
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'presentation_id', 'title', 'promo_text', 'old_price', 'new_price', 'currency_id', 'validity', 'time'], 'required'],
            [['activity_id', 'offer_id', 'presentation_id', 'old_price', 'new_price', 'currency_id', 'discount', 'voucher', 'max_subscribers', 'scheduling'], 'integer'],
            [['promo_text', 'description'], 'string'],
            [['active_from', 'validity', 'time'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['subtitle'], 'string', 'max' => 150],
            [['not_valid_for'], 'string', 'max' => 250]
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
            'offer_id' => 'Ponuda.',
            'presentation_id' => 'Presentation ID',
            'title' => 'Naslov promocije.',
            'subtitle' => 'Podnaslov promocije.',
            'promo_text' => 'Tekst promocije usluga.',
            'old_price' => 'Redovna cena izvršenja usluge.',
            'new_price' => 'Nova promotivna cena izvršenja usluge.',
            'currency_id' => 'Valuta u kojoj se obračunava cena.',
            'discount' => 'Popust.',
            'voucher' => 'Vaučer za promociju usluge. 0 - nepotreban; 1 - potreban.',
            'max_subscribers' => 'Maksimalna broj kupaca promocije usluge.',
            'scheduling' => 'Broj potrebnih dana pre kojih se mora prijaviti za izvršenje usluge.',
            'not_valid_for' => 'Spisak onih za koje ova promocija ne važi.',
            'active_from' => 'Datum od kada je promocija važeća.',
            'validity' => 'Vreme do kada važi promocija usluge.',
            'time' => 'Datum i vreme promocije usluga.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionImages()
    {
        return $this->hasMany(PromotionImages::className(), ['promotion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['promotion_id' => 'id']);
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
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::className(), ['promo_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PromotionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromotionsQuery(get_called_class());
    }
}
