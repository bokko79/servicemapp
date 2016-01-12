<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_currencies".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $state_id
 * @property string $rate
 *
 * @property Bids[] $bids
 * @property OrderServices[] $orderServices
 * @property Promotions[] $promotions
 * @property ProviderServices[] $providerServices
 * @property UserDetails[] $userDetails
 * @property UserOrder[] $userOrders
 */
class CsCurrencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'rate'], 'required'],
            [['state_id'], 'integer'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 30],
            [['code'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Valuta.',
            'code' => 'Kod valute.',
            'state_id' => 'Država valute.',
            'rate' => 'Kurs valute u odnosu na EUR.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        return $this->hasMany(Promotions::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasMany(UserDetails::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::className(), ['currency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsCurrenciesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsCurrenciesQuery(get_called_class());
    }
}
