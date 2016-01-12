<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agreements".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $type
 * @property string $validity
 * @property string $transaction_id
 * @property integer $voucher_issued
 * @property string $time
 * @property string $description
 *
 * @property Activities $activity
 * @property Offers $offer
 * @property Feedback[] $feedbacks
 * @property FeedbackOnProvider[] $feedbackOnProviders
 * @property FeedbackOnUser[] $feedbackOnUsers
 * @property Transactions[] $transactions
 */
class Agreements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agreements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'time'], 'required'],
            [['activity_id', 'offer_id', 'transaction_id', 'voucher_issued'], 'integer'],
            [['type', 'description'], 'string'],
            [['validity', 'time'], 'safe']
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
            'type' => 'Vrsta sporazuma.',
            'validity' => 'Validity',
            'transaction_id' => 'Transakcija',
            'voucher_issued' => 'Voucher Issued',
            'time' => 'Time',
            'description' => 'Description',
        ];
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
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['agreement_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnProviders()
    {
        return $this->hasMany(FeedbackOnProvider::className(), ['agreement_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackOnUsers()
    {
        return $this->hasMany(FeedbackOnUser::className(), ['agreement_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['agreement_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AgreementsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgreementsQuery(get_called_class());
    }
}
