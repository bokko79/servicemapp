<?php

namespace frontend\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
    public $new_time = 0;
    public $service;
    public $new_user = 0;


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
        $service = $this->service;
        $loc_req = ['loc_id', 'safe'];
        $loc2_req = ['loc_id2', 'safe'];
        $time_req = ['time_req', 'safe'];
        $time_end_req = ['time_end_req', 'safe'];
        if($service){
            switch ($service->location) {
                case 1:
                    $loc_req = ['loc_id', 'required'];
                    $loc2_req = ['loc_id2', 'safe'];
                    break;
                case 2:
                    $loc_req = ['loc_id', 'required'];
                    $loc2_req = ['loc_id2', 'required'];
                    break;
                default: 
                    $loc_req = ['loc_id', 'safe'];
                    $loc2_req = ['loc_id2', 'safe'];
                    break;
            }
            $time_req = ($service->time==1 || $service->time==3) ? ['delivery_starts', 'required', 'message'=>Yii::t('app', 'Datum i vreme početka izvršenja usluge su obavezni.')] : ['delivery_starts', 'safe'];
            $time_end_req = ($service->time==3) ? ['delivery_ends', 'required', 'message'=>Yii::t('app', 'Datum i vreme završetka izvršenja usluge su obavezni.')] : ['delivery_ends', 'safe'];
        }
            
        return [
            [['activity_id'], 'required'],
            [['activity_id', 'loc_id', 'loc_id2', 'loc_within', 'registered_to', 'frequency', 'duration', 'currency_id', 'process_id', 'hit_counter'], 'integer'],
            [['delivery_ends', 'validity', 'update_time', 'success_time', 'budget', 'delivery_time_operator', 'duration_operator', 'budget_operator'], 'safe'],
            $loc_req,
            $loc2_req,
            $time_req,
            $time_end_req,
            [['validity'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s', strtotime('+7 days'));
            }],
            [['lang_code'], 'string', 'max' => 2],         
            [['class', 'order_type', 'frequency_unit', 'duration_unit'], 'string'],
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
    public function getOrderSkills()
    {
        return $this->hasMany(OrderSkills::className(), ['order_id' => 'id']);
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
    public function getIndustry()
    {
        return $this->orderServices[0]->service->industry;
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
    public function getLoc2()
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

    public function checkIfLocation()
    {
        return ($this->service->location!=0) ? 0 : 1;
    }

    public function checkIfTime()
    {
        return ($this->service->time!=0) ? 0 : 1;
    }

    public function checkIfFreq()
    {
        return ($this->service->frequency!=0) ? 0 : 1;
    }

    public function getNoTime()
    {
        return 2-$this->checkIfLocation();
    }

    public function getNoFreq()
    {
        return 3-$this->checkIfLocation()-$this->checkIfTime();
    }

    public function getNoVal()
    {
        return 4-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfFreq();
    }

    public function getNoBudget()
    {
        return 5-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfFreq();
    }

    public function getNoOther()
    {
        return 6-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfFreq();
    }

    public function getNoUac()
    {
        return 7-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfFreq();
    }
}
