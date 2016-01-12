<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "feedback_on_provider".
 *
 * @property string $id
 * @property string $feedback_id
 * @property string $agreement_id
 * @property string $user_id
 * @property string $provider_id
 * @property string $price
 * @property string $quality
 * @property string $responsiveness
 * @property string $punctuality
 * @property string $professionalism
 * @property string $time
 *
 * @property Provider $provider
 * @property User $user
 * @property Feedback $feedback
 * @property Agreements $agreement
 */
class FeedbackOnProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback_on_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'agreement_id', 'user_id', 'provider_id', 'time'], 'required'],
            [['feedback_id', 'agreement_id', 'user_id', 'provider_id'], 'integer'],
            [['price', 'quality', 'responsiveness', 'punctuality', 'professionalism'], 'string'],
            [['time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'feedback_id' => Yii::t('app', 'Feedback ID'),
            'agreement_id' => Yii::t('app', 'Agreement ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'price' => Yii::t('app', 'Price'),
            'quality' => Yii::t('app', 'Quality'),
            'responsiveness' => Yii::t('app', 'Responsiveness'),
            'punctuality' => Yii::t('app', 'Punctuality'),
            'professionalism' => Yii::t('app', 'Professionalism'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasOne(Feedback::className(), ['id' => 'feedback_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasOne(Agreements::className(), ['id' => 'agreement_id']);
    }
}
