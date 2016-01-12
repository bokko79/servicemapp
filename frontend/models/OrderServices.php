<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'provider_service_id' => Yii::t('app', 'Provider Service ID'),
            'qty' => Yii::t('app', 'Qty'),
            'consumer' => Yii::t('app', 'Consumer'),
            'frequency' => Yii::t('app', 'Frequency'),
            'frequency_unit' => Yii::t('app', 'Frequency Unit'),
            'issue_text' => Yii::t('app', 'Issue Text'),
            'note' => Yii::t('app', 'Note'),
            'rec_price' => Yii::t('app', 'Rec Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'turnkey' => Yii::t('app', 'Turnkey'),
            'support' => Yii::t('app', 'Support'),
            'description' => Yii::t('app', 'Description'),
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
}
