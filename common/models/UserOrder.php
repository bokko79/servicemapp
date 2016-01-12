<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property string $id
 * @property string $user_id
 * @property string $invoice_no
 * @property string $order_no
 * @property string $item
 * @property string $item_title
 * @property string $promo_id
 * @property integer $quantity
 * @property string $price
 * @property integer $currency_id
 * @property integer $tax_rate
 * @property integer $discount
 * @property string $total_price
 * @property string $invoice_location
 * @property string $bank_account
 * @property string $status
 * @property string $time
 * @property string $update_time
 * @property string $opis
 *
 * @property CsCurrencies $currency
 * @property Promotions $promo
 * @property User $user
 */
class UserOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_no', 'item', 'item_title', 'quantity', 'price', 'currency_id', 'tax_rate', 'discount', 'total_price', 'invoice_location', 'bank_account', 'status', 'time'], 'required'],
            [['user_id', 'order_no', 'promo_id', 'quantity', 'price', 'currency_id', 'tax_rate', 'discount', 'total_price'], 'integer'],
            [['item', 'status', 'opis'], 'string'],
            [['time', 'update_time'], 'safe'],
            [['invoice_no'], 'string', 'max' => 11],
            [['item_title'], 'string', 'max' => 250],
            [['invoice_location'], 'string', 'max' => 40],
            [['bank_account'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'invoice_no' => 'Broj računa/fakture.',
            'order_no' => 'Broj porudžbenice.',
            'item' => 'Proizvod koji se kupuje. Promocija usluge. Članstvo. Baner.',
            'item_title' => 'Naslov stavke (proizvoda).',
            'promo_id' => 'Promocija usluge (ukoliko se ona kupuje).',
            'quantity' => 'Količina.',
            'price' => 'Cena.',
            'currency_id' => 'Valuta.',
            'tax_rate' => 'Porez u %.',
            'discount' => 'Popust u %.',
            'total_price' => 'Ukupna cena (TOTAL).',
            'invoice_location' => 'Mesto plaćanja.',
            'bank_account' => 'Račun plaćanja.',
            'status' => 'Status porudžbenice. payed - plaćeno; unpayed - neplaćeno; rejected - odbačeno; suspended - zamrznuto; refunded - vraćen novac; other - ostalo. ',
            'time' => 'Datum i vreme porudžbenice.',
            'update_time' => 'Datum i vreme izmene porudžbenice.',
            'opis' => 'Opis stavke.',
        ];
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
    public function getPromo()
    {
        return $this->hasOne(Promotions::className(), ['id' => 'promo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return UserOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserOrderQuery(get_called_class());
    }
}
