<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property string $id
 * @property string $user_id
 * @property string $action
 * @property string $alias
 * @property string $alias2
 * @property string $time
 *
 * @property User $user
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'time'], 'required'],
            [['user_id', 'alias', 'alias2'], 'integer'],
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
            'id' => 'ID',
            'user_id' => 'User ID',
            'action' => 'Action',
            'alias' => 'Alias',
            'alias2' => 'Alias2',
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
