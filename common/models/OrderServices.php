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
 * @property string $title
 * @property integer $item_count
 * @property string $amount
 * @property string $amount_to
 * @property string $amount_operator
 * @property integer $duration
 * @property string $duration_unit
 * @property string $duration_operator
 * @property string $issue_text
 * @property string $note
 * @property string $video_link
 *
 * @property OrderServiceImages[] $orderServiceImages
 * @property OrderServiceIssues[] $orderServiceIssues
 * @property OrderServiceMethods[] $orderServiceMethods
 * @property OrderServiceSpecs[] $orderServiceSpecs
 * @property ProviderServices $providerService
 * @property Activities $activity
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
            [['activity_id', 'order_id', 'service_id', 'provider_service_id', 'item_count', 'amount', 'amount_to', 'duration'], 'integer'],
            [['amount_operator', 'duration_unit', 'duration_operator', 'issue_text', 'note'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['video_link'], 'string', 'max' => 128],
            [['provider_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProviderServices::className(), 'targetAttribute' => ['provider_service_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
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
            'title' => Yii::t('app', 'Title'),
            'item_count' => Yii::t('app', 'Item Count'),
            'amount' => Yii::t('app', 'Amount'),
            'amount_to' => Yii::t('app', 'Amount To'),
            'amount_operator' => Yii::t('app', 'Amount Operator'),
            'duration' => Yii::t('app', 'Trajanje'),
            'duration_unit' => Yii::t('app', 'Jedinica vremena'),
            'duration_operator' => Yii::t('app', 'Trajanje operator'),
            'issue_text' => Yii::t('app', 'Issue Text'),
            'note' => Yii::t('app', 'Note'),
            'video_link' => Yii::t('app', 'Video Link'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getFiles()
    {
        return $this->hasMany(OrderServiceObjectFiles::className(), ['order_service_id' => 'id']);
    }*/

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
    public function getOrderServiceActionProperties()
    {
        return $this->hasMany(OrderServiceActionProperties::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceObjectProperties()
    {
        return $this->hasMany(OrderServiceObjectProperties::className(), ['order_service_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(OrderServiceObjectFiles::className(), ['order_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {   
        $images = [];     
        if($documents = $this->documents)
        {
            foreach($documents as $document){
                if($document->file->type=='image'){
                    $images[] = $document->file;
                }
            }
        }
        return $images;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdfs()
    {   
        $pdf = [];     
        if($documents = $this->documents)
        {
            foreach($documents as $document){
                if($document->file->type=='pdf'){
                    $pdf[] = $document->file;
                }
            }
        }
        return $pdf;
    }
}
