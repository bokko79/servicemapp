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
 * @property string $title
 * @property string $amount
 * @property string $amount_operator
 * @property integer $consumer
 * @property integer $consumer_children
 * @property string $issue_text
 * @property string $note
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
            [['activity_id', 'order_id', 'service_id'], 'required'],
            [['activity_id', 'order_id', 'service_id', 'provider_service_id', 'amount', 'amount_to', 'consumer', 'consumer_to', 'consumer_children'], 'integer'],
            [['title', 'issue_text', 'note', 'description'], 'string'],
            [['amount_operator', 'consumer_operator'], 'safe']
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
            'amount' => Yii::t('app', 'Amount'),
            'consumer' => Yii::t('app', 'Consumer'),
            'consumer_children' => Yii::t('app', 'Frequency'),
            'amount_operator' => Yii::t('app', 'Amount operator'),
            'issue_text' => Yii::t('app', 'Issue Text'),
            'note' => Yii::t('app', 'Note'),
            'title' => Yii::t('app', 'Title'),            
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(OrderServiceImages::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssues()
    {
        return $this->hasMany(OrderServiceIssues::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMethods()
    {
        return $this->hasMany(OrderServiceMethods::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecs()
    {
        return $this->hasMany(OrderServiceSpecs::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectModels()
    {
        return $this->hasMany(OrderServiceObjectModels::className(), ['order_service_id' => 'id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getCustomTitle()
    {
        return c($this->service->action->tName). ' ' . 
                (($this->objectModels) ? $this->objectModels[0]->object->tNameGen : $this->service->object->tNameGen);
    }
}
