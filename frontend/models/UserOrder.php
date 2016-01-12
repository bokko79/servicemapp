<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'invoice_no' => Yii::t('app', 'Invoice No'),
            'order_no' => Yii::t('app', 'Order No'),
            'item' => Yii::t('app', 'Item'),
            'item_title' => Yii::t('app', 'Item Title'),
            'promo_id' => Yii::t('app', 'Promo ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'discount' => Yii::t('app', 'Discount'),
            'total_price' => Yii::t('app', 'Total Price'),
            'invoice_location' => Yii::t('app', 'Invoice Location'),
            'bank_account' => Yii::t('app', 'Bank Account'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'opis' => Yii::t('app', 'Opis'),
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
