<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_opening_hours".
 *
 * @property integer $id
 * @property integer $provider_id
 * @property string $day_of_week
 * @property string $open
 * @property string $closed
 * @property integer $working_time
 */
class ProviderOpeningHours extends \yii\db\ActiveRecord
{
    public $dayLabel;
    public $global_time_start;
    public $global_time_end;

    public $workingDay = [];

    public $timezone;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_opening_hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'provider_id', 'day_of_week'], 'required'],
            [['id', 'day_of_week', 'provider_id', 'working_time'], 'integer'],
            [['open', 'closed'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'day_of_week' => Yii::t('app', 'Day Of Week'),
            'open' => Yii::t('app', 'Open'),
            'closed' => Yii::t('app', '-'),
            'working_time' => Yii::t('app', 'Working Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }
}
