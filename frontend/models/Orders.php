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
            [['activity_id', 'loc_id', 'loc_id2', 'loc_within', 'registered_to', 'phone_contact', 'turn_key', 'process_id', 'success', 'hit_counter'], 'integer'],
            [['delivery_starts', 'delivery_ends', 'validity', 'update_time', 'success_time'], 'safe'],
            [['class', 'order_type'], 'string'],
            [['lang_code'], 'string', 'max' => 2]
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
            'loc_id' => Yii::t('app', 'Loc ID'),
            'loc_id2' => Yii::t('app', 'Loc Id2'),
            'loc_within' => Yii::t('app', 'Loc Within'),
            'delivery_starts' => Yii::t('app', 'Delivery Starts'),
            'delivery_ends' => Yii::t('app', 'Delivery Ends'),
            'validity' => Yii::t('app', 'Validity'),
            'update_time' => Yii::t('app', 'Update Time'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'class' => Yii::t('app', 'Class'),
            'registered_to' => Yii::t('app', 'Registered To'),
            'phone_contact' => Yii::t('app', 'Phone Contact'),
            'turn_key' => Yii::t('app', 'Turn Key'),
            'order_type' => Yii::t('app', 'Order Type'),
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
}
