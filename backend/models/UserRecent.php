<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_recent".
 *
 * @property string $id
 * @property string $user_id
 * @property string $recent_type
 * @property string $recent_id
 * @property string $time
 *
 * @property User $user
 */
class UserRecent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_recent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'recent_type', 'recent_id', 'time'], 'required'],
            [['user_id', 'recent_id'], 'integer'],
            [['recent_type'], 'string'],
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
            'user_id' => 'User ID',
            'recent_type' => 'Recent Type',
            'recent_id' => 'Recent ID',
            'time' => 'Time',
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
