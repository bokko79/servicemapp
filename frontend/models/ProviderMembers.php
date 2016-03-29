<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_members".
 *
 * @property string $id
 * @property string $user_id
 * @property string $provider_id
 * @property string $status
 * @property string $role
 * @property string $request_time
 * @property string $join_time
 * @property string $leave_time
 * @property string $description
 */
class ProviderMembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'provider_id', 'status', 'role', 'request_time'], 'required'],
            [['user_id', 'provider_id'], 'integer'],
            [['status', 'role', 'description'], 'string'],
            [['request_time', 'join_time', 'leave_time'], 'safe'],
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
            'provider_id' => Yii::t('app', 'Provider ID'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'request_time' => Yii::t('app', 'Request Time'),
            'join_time' => Yii::t('app', 'Join Time'),
            'leave_time' => Yii::t('app', 'Leave Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
