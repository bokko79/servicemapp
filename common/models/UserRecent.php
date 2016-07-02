<?php

namespace common\models;

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
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'recent_type' => Yii::t('app', 'Recent Type'),
            'recent_id' => Yii::t('app', 'Recent ID'),
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
