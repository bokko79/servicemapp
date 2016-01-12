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
            'id' => 'ID',
            'user_id' => 'Korisnik koje je kreator eventa.',
            'event' => 'Event.',
            'event_id' => 'ID eventa.',
            'event_object_id' => 'ID predmeta eventa.',
            'market' => 'Event za market: 0 - ne, 1 - da.',
            'time' => 'Vreme eventa.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return EventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventsQuery(get_called_class());
    }
}
