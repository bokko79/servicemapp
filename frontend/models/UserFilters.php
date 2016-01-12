<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_filters".
 *
 * @property string $user_id
 * @property integer $kat
 * @property integer $del
 * @property integer $act
 * @property string $loc_country
 * @property string $loc_state
 * @property string $loc
 * @property integer $status
 * @property integer $time
 * @property integer $deadline
 * @property integer $ratingmin
 * @property integer $ratingmax
 * @property integer $prate
 * @property integer $urate
 * @property string $language
 * @property integer $lang
 * @property string $update_time
 *
 * @property User $user
 */
class UserFilters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_filters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'kat', 'del', 'act', 'loc_country', 'loc_state', 'loc', 'status', 'time', 'deadline', 'ratingmin', 'ratingmax', 'prate', 'urate', 'lang'], 'integer'],
            [['update_time'], 'safe'],
            [['language'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'kat' => Yii::t('app', 'Kat'),
            'del' => Yii::t('app', 'Del'),
            'act' => Yii::t('app', 'Act'),
            'loc_country' => Yii::t('app', 'Loc Country'),
            'loc_state' => Yii::t('app', 'Loc State'),
            'loc' => Yii::t('app', 'Loc'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
            'deadline' => Yii::t('app', 'Deadline'),
            'ratingmin' => Yii::t('app', 'Ratingmin'),
            'ratingmax' => Yii::t('app', 'Ratingmax'),
            'prate' => Yii::t('app', 'Prate'),
            'urate' => Yii::t('app', 'Urate'),
            'language' => Yii::t('app', 'Language'),
            'lang' => Yii::t('app', 'Lang'),
            'update_time' => Yii::t('app', 'Update Time'),
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
