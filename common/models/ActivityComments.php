<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_comments".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $user_id
 * @property string $text
 * @property string $update_time
 *
 * @property Activities $activity
 * @property User $user
 */
class ActivityComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'text', 'update_time'], 'required'],
            [['activity_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['update_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Stavka.',
            'user_id' => 'Pošiljalac komentara - komentator.',
            'text' => 'Tekst kometnara na zahtev za uslugu.',
            'update_time' => 'Datum i vreme komentara.',
        ];
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
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
