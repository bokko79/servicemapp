<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property string $id
 * @property string $user_id
 * @property string $code
 * @property string $alias
 * @property string $alias2
 * @property string $body
 * @property integer $is_read
 * @property string $notification_time
 *
 * @property User $user
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'notification_time'], 'required'],
            [['user_id', 'alias', 'is_read'], 'integer'],
            [['code', 'body'], 'string'],
            [['notification_time'], 'safe'],
            [['alias2'], 'string', 'max' => 20]
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
            'code' => Yii::t('app', 'Code'),
            'alias' => Yii::t('app', 'Alias'),
            'alias2' => Yii::t('app', 'Alias2'),
            'body' => Yii::t('app', 'Body'),
            'is_read' => Yii::t('app', 'Is Read'),
            'notification_time' => Yii::t('app', 'Notification Time'),
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
