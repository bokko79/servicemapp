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
            'id' => Yii::t('app', 'ID'),
            'thread_id' => Yii::t('app', 'Thread ID'),
            'sender' => Yii::t('app', 'Sender'),
            'body' => Yii::t('app', 'Body'),
            'counter' => Yii::t('app', 'Counter'),
            'time' => Yii::t('app', 'Time'),
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
}
