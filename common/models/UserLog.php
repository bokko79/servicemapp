<?php

namespace common\models;

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
            [['time'], 'safe'],
            [['time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
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
            'action' => Yii::t('app', 'Action'),
            'alias' => Yii::t('app', 'Alias'),
            'alias2' => Yii::t('app', 'Alias2'),
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
