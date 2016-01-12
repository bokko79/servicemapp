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
            'id' => 'ID',
            'sender' => 'Inicijator razgovora. Pošiljalac prve poruke.',
            'receiver' => 'Drugi učesnik u razgovoru. Primalac prve poruke.',
            'is_read' => 'Inicijator razgovora je pročitao primljenu poruku. 0 - nije; 1 - jeste.',
            'is_read_rec' => 'Drugi učesnik u razgovoru je pročitao primljenu poruku. 0 - nije; 1 - jeste.',
            'del' => 'Inicijator razgovora je obrisao razgovor. 0 - nije; 1 - jeste.',
            'delbyrec' => 'Drugi učesnik u razgovoru je obrisao razgovor. 0 - nije; 1 - jeste.',
            'time' => 'Datum i vreme početka razgovora.',
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

    /**
     * @inheritdoc
     * @return MsgThreadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MsgThreadQuery(get_called_class());
    }
}
