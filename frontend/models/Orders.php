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
 * @property string $registered_to
 * @property integer $process_id
 * @property string $lang_code
 * @property string $loc_id
 * @property string $loc_id2
 * @property integer $coverage
 * @property integer $coverage_within
 * @property string $delivery_starts
 * @property string $delivery_ends
 * @property string $delivery_time_operator
 * @property integer $consumer
 * @property integer $consumer_to
 * @property string $consumer_operator
 * @property integer $consumer_children
 * @property integer $frequency
 * @property string $frequency_unit
 * @property string $validity
 * @property string $budget
 * @property integer $currency_id
 * @property string $budget_operator
 * @property integer $shipping
 * @property integer $installation
 * @property integer $support
 * @property integer $turn_key
 * @property integer $tools
 * @property integer $phone_contact
 * @property string $title
 * @property string $note
 * @property integer $success
 * @property string $success_time
 * @property string $order_type
 * @property string $class
 * @property string $update_time
 * @property string $hit_counter
 *
 * @property CsLanguages $langCode
 * @property CsProcesses $process
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
        $consumer = ($service->consumer==1) ? ['consumer', 'required', 'message'=>Yii::t('app', 'Unesite broj odraslih koji će koristiti ovu uslugu.')] : ['consumer', 'safe'];
        $consumer_children = ($service->consumer!=0 && $service->consumer_children==1) ? ['consumer_children', 'required', 'message'=>Yii::t('app', 'Unesite broj dece koja će koristiti ovu uslugu.')] : ['consumer_children', 'safe'];
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
            [['activity_id', 'registered_to', 'process_id', 'loc_id', 'loc_id2', 'coverage', 'coverage_within', 'consumer', 'consumer_to', 'consumer_children', 'frequency', 'budget', 'currency_id', 'shipping', 'installation', 'support', 'turn_key', 'tools', 'phone_contact', 'success', 'hit_counter'], 'integer'],
            [['delivery_starts', 'delivery_ends', 'validity', 'success_time', 'update_time'], 'safe'],
            $loc_req,
            $loc2_req,
            $time_req,
            $time_end_req,
            $consumer,
            $consumer_children,
            ['consumer', 'integer', 'min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max],
            [['delivery_time_operator', 'consumer_operator', 'budget_operator'], 'default', 'value'=>'exact'],
            [['validity'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s', strtotime('+7 days'));
            }],
            [['lang_code'], 'string', 'max' => 2],   
            [['title'], 'string', 'max' => 100],      
            [['delivery_time_operator', 'consumer_operator', 'frequency_unit', 'budget_operator', 'note', 'order_type', 'class'], 'string'],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => CsLanguages::className(), 'targetAttribute' => ['lang_code' => 'code']],
            [['process_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsProcesses::className(), 'targetAttribute' => ['process_id' => 'id']],
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
            'coverage' => Yii::t('app', 'Coverage'),
            'coverage_within' => Yii::t('app', 'U radijusu lokacije'),
            'delivery_starts' => Yii::t('app', 'Početak izvršenja usluge'),
            'delivery_ends' => Yii::t('app', 'Završetak izvršenja usluge'),
            'delivery_time_operator' => Yii::t('app', 'Delivery time operator'),
            'consumer' => Yii::t('app', 'Consumer'),
            'consumer_to' => Yii::t('app', 'Consumer To'),
            'consumer_operator' => Yii::t('app', 'Consumer Operator'),
            'consumer_children' => Yii::t('app', 'Consumer Children'),
            'validity' => Yii::t('app', 'Rok za slanje ponuda'),            
            'frequency' => Yii::t('app', 'Učestalost'),
            'frequency_unit' => Yii::t('app', 'Jedinica učestalosti'),
            'budget' => Yii::t('app', 'Budget'),
            'budget_operator' => Yii::t('app', 'Budget operator'),
            'currency_id' => Yii::t('app', 'Valuta'),
            'shipping' => Yii::t('app', 'Shipping'),
            'installation' => Yii::t('app', 'Installation'),
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
            'title' => Yii::t('app', 'Title'),
            'note' => Yii::t('app', 'Note'),
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

    public function checkIfSkills()
    {
        return ($this->service->industry->skills) ? 0 : 1;
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

    public function checkIfConsumer()
    {
        return ($this->service->consumer!=0) ? 0 : 1;
    }

    public function getNoLocation()
    {
        return 2-$this->checkIfSkills();
    }

    public function getNoTime()
    {
        return 3-$this->checkIfSkills()-$this->checkIfLocation();
    }

    public function getNoConsumer()
    {
        return 4-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime();
    }

    public function getNoFreq()
    {
        return 5-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfConsumer();
    }   

    public function getNoBudget()
    {
        return 6-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfConsumer()-$this->checkIfFreq();
    }

    public function getNoVal()
    {
        return 7-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfConsumer()-$this->checkIfFreq();
    }

    public function getNoOther()
    {
        return 8-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfConsumer()-$this->checkIfFreq();
    }

    public function getNoUac()
    {
        return 9-$this->checkIfSkills()-$this->checkIfLocation()-$this->checkIfTime()-$this->checkIfConsumer()-$this->checkIfFreq();
    }

    public function afterSave($insert, $changedAttributes)
    {
        // user log
        $userLog = new \frontend\models\UserLog();
        $userLog->user_id = Yii::$app->user->id;
        $userLog->action = $insert ? 'order_created' : 'order_updated';
        $userLog->alias = $this->id;
        $userLog->time = date('Y-m-d H:i:s');
        $userLog->save();
        
        parent::afterSave($insert, $changedAttributes);     
    }    
}
