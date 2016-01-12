<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_tracking".
 *
 * @property integer $id
 * @property string $activity_id
 * @property string $user_id
 * @property integer $follow
 *
 * @property Activities $activity
 * @property User $user
 */
class ActivityTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id'], 'required'],
            [['activity_id', 'user_id', 'follow'], 'integer']
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
            'user_id' => 'Korisnik.',
            'follow' => 'Aktivno praćenje. 0 - nije; 1 - jeste.',
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

    /**
     * @inheritdoc
     * @return ActivityTrackingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityTrackingQuery(get_called_class());
    }
}
