<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $loc_id
 * @property string $loc_id2
 * @property integer $loc_within
 * @property string $delivery_starts
 * @property string $delivery_ends
 * @property string $validity
 * @property string $update_time
 * @property string $lang_code
 * @property string $class
 * @property string $registered_to
 * @property integer $phone_contact
 * @property integer $turn_key
 * @property string $order_type
 * @property integer $process_id
 * @property integer $success
 * @property string $success_time
 * @property string $hit_counter
 *
 * @property Bids[] $bids
 * @property OrderServices[] $orderServices
 * @property Locations $loc
 * @property Locations $locId2
 * @property CsLanguages $langCode
 * @property CsProcesses $process
 * @property Provider $registeredTo
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id'], 'required'],
            [['activity_id', 'loc_id', 'loc_id2', 'loc_within', 'registered_to', 'frequency', 'duration', 'currency_id', 'process_id', 'hit_counter'], 'integer'],
            [['delivery_starts', 'delivery_ends', 'validity', 'update_time', 'success_time', 'budget', 'delivery_time_operator', 'duration_operator', 'budget_operator'], 'safe'],
            [['delivery_starts', 'delivery_ends', 'validity', 'update_time', 'success_time'], 'date', 'message'=>'Format mora biti d-M-yyyy h:ii'],
            [['class', 'order_type', 'frequency_unit', 'duration_unit'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            ['order_type', 'default', 'value' => 'single'],
            ['class', 'default', 'value' => 'global'],
            [['delivery_time_operator', 'duration_operator', 'budget_operator',], 'default', 'value' => 'exact'],
            ['lang_code', 'default', 'value' => Yii::$app->language],
            ['hit_counter', 'default', 'value' => 0],
            [['phone_contact', 'turn_key', 'support', 'tools', 'success'], 'boolean'],
            [['phone_contact', 'turn_key', 'support', 'tools', 'success'], 'default', 'value' => 0],
            [['validity'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s', strtotime('+7 days'));
            }],
            ['delivery_starts', 'compare', 'compareAttribute'=>'validity', 'operator'=>'>'],
            ['budget', 'number', 'min'=>0],
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
            'loc_id' => Yii::t('app', 'Lokacija'),
            'loc_id2' => Yii::t('app', 'Krajnja destinacija'),
            'loc_within' => Yii::t('app', 'U radijusu lokacije'),
            'delivery_starts' => Yii::t('app', 'Početak izvršenja usluge'),
            'delivery_ends' => Yii::t('app', 'Završetak izvršenja usluge'),
            'delivery_time_operator' => Yii::t('app', 'Delivery time operator'),
            'validity' => Yii::t('app', 'Rok za slanje ponuda'),
            'duration' => Yii::t('app', 'Trajanje'),
            'duration_unit' => Yii::t('app', 'Jedinica vremena'),
            'duration_operator' => Yii::t('app', 'Trajanje operator'),
            'frequency' => Yii::t('app', 'Učestalost'),
            'frequency_unit' => Yii::t('app', 'Jedinica učestalosti'),
            'budget' => Yii::t('app', 'Budget'),
            'budget_operator' => Yii::t('app', 'Budget operator'),
            'currency_id' => Yii::t('app', 'Valuta'),
            'update_time' => Yii::t('app', 'Update Time'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'class' => Yii::t('app', 'Class'),
            'registered_to' => Yii::t('app', 'Registered To'),
            'phone_contact' => Yii::t('app', 'Kontakt telefon'),
            'turn_key' => Yii::t('app', 'Ključ u ruke'),
            'tools' => Yii::t('app', 'Alat i pribor'),
            'support' => Yii::t('app', 'Podrška'),
            'order_type' => Yii::t('app', 'Vrsta porudžbine'),
            'process_id' => Yii::t('app', 'Process ID'),
            'success' => Yii::t('app', 'Success'),
            'success_time' => Yii::t('app', 'Success Time'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['order_id' => 'id']);
    }

    public function getServices() 
    {
        return $this->hasMany(CsServices::className(), ['id' => 'service_id'])
          ->viaTable('order_services', ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocId2()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(CsProcesses::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredTo()
    {
        return $this->hasOne(Provider::className(), ['id' => 'registered_to']);
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
    public function getUser()
    {
        return $this->activity->user;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function validityPercentage()
    {
        $start_f = new \DateTime($this->activity->time);
        $start = $start_f->format('U');
        $validity_f = new \DateTime($this->validity);
        $validity = $validity_f->format('U');
        $now_f = new \DateTime();
        $now = $now_f->format('U');

        return round(($now-$start)*100/($validity-$start));
    }
}
