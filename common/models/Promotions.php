<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $offer_id
 * @property string $presentation_id
 * @property string $title
 * @property string $subtitle
 * @property string $promo_text
 * @property string $old_price
 * @property string $new_price
 * @property integer $currency_id
 * @property integer $discount
 * @property integer $voucher
 * @property integer $max_subscribers
 * @property integer $scheduling
 * @property string $not_valid_for
 * @property string $active_from
 * @property string $validity
 * @property string $time
 *
 * @property PromotionFiles[] $promotionFiles
 * @property PromotionServices[] $promotionServices
 * @property CsCurrencies $currency
 * @property Activities $activity
 * @property Offers $offer
 * @property Presentations $presentation
 * @property UserOrder[] $userOrders
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'offer_id', 'presentation_id', 'title', 'promo_text', 'old_price', 'new_price', 'currency_id', 'validity', 'time'], 'required'],
            [['activity_id', 'offer_id', 'presentation_id', 'old_price', 'new_price', 'currency_id', 'discount', 'voucher', 'max_subscribers', 'scheduling'], 'integer'],
            [['promo_text'], 'string'],
            [['active_from', 'validity', 'time'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['subtitle'], 'string', 'max' => 150],
            [['not_valid_for'], 'string', 'max' => 250]
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
            'offer_id' => Yii::t('app', 'Offer ID'),
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'promo_text' => Yii::t('app', 'Promo Text'),
            'old_price' => Yii::t('app', 'Old Price'),
            'new_price' => Yii::t('app', 'New Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'discount' => Yii::t('app', 'Discount'),
            'voucher' => Yii::t('app', 'Voucher'),
            'max_subscribers' => Yii::t('app', 'Max Subscribers'),
            'scheduling' => Yii::t('app', 'Scheduling'),
            'not_valid_for' => Yii::t('app', 'Not Valid For'),
            'active_from' => Yii::t('app', 'Active From'),
            'validity' => Yii::t('app', 'Validity'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionFiles()
    {
        return $this->hasMany(PromotionFiles::className(), ['promotion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['promotion_id' => 'id']);
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
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::className(), ['promo_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        // user log
        $userLog = new \common\models\UserLog();
        $userLog->user_id = Yii::$app->user->id;
        $userLog->action = $insert ? 'promotion_created' : 'promotion_updated';
        $userLog->alias = $this->id;
        $userLog->time = date('Y-m-d H:i:s');
        $userLog->save();
        
        parent::afterSave($insert, $changedAttributes);     
    }
}
