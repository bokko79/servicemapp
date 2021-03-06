<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offers".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $type
 * @property string $update_time
 *
 * @property Agreements[] $agreements
 * @property Bids[] $bids
 * @property Feedback[] $feedbacks
 * @property Activities $activity
 * @property Presentations[] $presentations
 * @property Promotions[] $promotions
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'type', 'update_time'], 'required'],
            [['activity_id'], 'integer'],
            [['type'], 'string'],
            [['update_time'], 'safe']
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
            'type' => Yii::t('app', 'Type'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgreements()
    {
        return $this->hasMany(Agreements::className(), ['offer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['offer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['offer_id' => 'id']);
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
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['offer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        return $this->hasMany(Promotions::className(), ['offer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function loadOffer($activity, $type='presentation')
    {
        $offer = new Offers();
        $offer->activity_id = $activity;
        $offer->type = $type;
        $offer->update_time = date('Y-m-d H:i:s');

        if($offer){
            return $offer;
        } else {
            return false; 
        }
    }
}
