<?php

namespace frontend\models;

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
            [['id', 'provider_id', 'day_of_week', 'open', 'closed'], 'required'],
            [['id', 'provider_id', 'working_time'], 'integer'],
            [['day_of_week'], 'string'],
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
            'closed' => Yii::t('app', 'Closed'),
            'working_time' => Yii::t('app', 'Working Time'),
        ];
    }
}
