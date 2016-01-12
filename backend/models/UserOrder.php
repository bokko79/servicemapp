<?php

namespace backend\models;

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
            'user_id' => 'User ID',
            'invoice_no' => 'Invoice No',
            'order_no' => 'Order No',
            'item' => 'Item',
            'item_title' => 'Item Title',
            'promo_id' => 'Promo ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'currency_id' => 'Currency ID',
            'tax_rate' => 'Tax Rate',
            'discount' => 'Discount',
            'total_price' => 'Total Price',
            'invoice_location' => 'Invoice Location',
            'bank_account' => 'Bank Account',
            'status' => 'Status',
            'time' => 'Time',
            'update_time' => 'Update Time',
            'opis' => 'Opis',
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
}
