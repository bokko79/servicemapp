<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property string $id
 * @property string $thread_id
 * @property string $sender
 * @property string $body
 * @property integer $counter
 * @property string $time
 *
 * @property MsgThread $thread
 * @property User $sender0
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thread_id', 'sender', 'body', 'time'], 'required'],
            [['thread_id', 'sender', 'counter'], 'integer'],
            [['body'], 'string'],
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
            'thread_id' => 'Razgovor.',
            'sender' => 'Pošiljalac poruke.',
            'body' => 'Tekst poruke.',
            'counter' => 'Broj poruke.',
            'time' => 'Datum i vreme poruke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThread()
    {
        return $this->hasOne(MsgThread::className(), ['id' => 'thread_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @inheritdoc
     * @return MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessagesQuery(get_called_class());
    }
}
