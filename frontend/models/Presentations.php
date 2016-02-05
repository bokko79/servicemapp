<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentations".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $provider_service_id
 * @property string $description
 *
 * @property PresentationImages[] $presentationImages
 * @property PresentationIssues[] $presentationIssues
 * @property PresentationMethods[] $presentationMethods
 * @property PresentationSpecs[] $presentationSpecs
 * @property Activities $activity
 * @property Offers $offer
 * @property Promotions[] $promotions
 */
class Presentations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'provider_service_id'], 'required'],
            [['activity_id', 'offer_id', 'provider_service_id'], 'integer'],
            [['description'], 'string'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'offer_id' => 'Offer ID',
            'provider_service_id' => 'Provider Service ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationImages()
    {
        return $this->hasMany(PresentationImages::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationIssues()
    {
        return $this->hasMany(PresentationIssues::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationMethods()
    {
        return $this->hasMany(PresentationMethods::className(), ['presentation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationSpecs()
    {
        return $this->hasMany(PresentationSpecs::className(), ['presentation_id' => 'id']);
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
    public function getPromotions()
    {
        return $this->hasMany(Promotions::className(), ['presentation_id' => 'id']);
    }
}
