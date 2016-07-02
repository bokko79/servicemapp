<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "msg_thread".
 *
 * @property string $id
 * @property string $sender
 * @property string $receiver
 * @property integer $is_read
 * @property integer $is_read_rec
 * @property integer $del
 * @property integer $delbyrec
 * @property string $time
 *
 * @property Messages[] $messages
 * @property User $sender0
 * @property User $receiver0
 */
class MsgThread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'msg_thread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'receiver', 'time'], 'required'],
            [['sender', 'receiver', 'is_read', 'is_read_rec', 'del', 'delbyrec'], 'integer'],
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
            'sender' => Yii::t('app', 'Sender'),
            'receiver' => Yii::t('app', 'Receiver'),
            'is_read' => Yii::t('app', 'Is Read'),
            'is_read_rec' => Yii::t('app', 'Is Read Rec'),
            'del' => Yii::t('app', 'Del'),
            'delbyrec' => Yii::t('app', 'Delbyrec'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['thread_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }
}
