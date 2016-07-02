<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $user_id
 * @property string $action
 * @property integer $marketed
 * @property string $time
 *
 * @property Activities $activity
 * @property User $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'action', 'time'], 'required'],
            [['activity_id', 'user_id', 'marketed'], 'integer'],
            [['action'], 'string'],
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
            'activity_id' => Yii::t('app', 'Activity ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'action' => Yii::t('app', 'Action'),
            'marketed' => Yii::t('app', 'Marketed'),
            'time' => Yii::t('app', 'Time'),
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
