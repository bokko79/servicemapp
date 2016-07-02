<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $event
 * @property string $event_id
 * @property string $event_object_id
 * @property integer $market
 * @property string $time
 *
 * @property User $user
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event', 'event_id', 'time'], 'required'],
            [['user_id', 'event_id', 'event_object_id', 'market'], 'integer'],
            [['event'], 'string'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'event' => Yii::t('app', 'Event'),
            'event_id' => Yii::t('app', 'Event ID'),
            'event_object_id' => Yii::t('app', 'Event Object ID'),
            'market' => Yii::t('app', 'Market'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
