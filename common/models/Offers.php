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
 * @property string $description
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
            [['type', 'description'], 'string'],
            [['update_time'], 'safe']
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
            'type' => 'Vrsta ponude.',
            'update_time' => 'Vreme promene ponude.',
            'description' => 'Opis stavke.',
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
     * @inheritdoc
     * @return OffersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OffersQuery(get_called_class());
    }
}
