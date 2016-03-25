<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_timetables".
 *
 * @property string $id
 * @property string $presentation_id
 * @property integer $day_of_week
 * @property string $time_start
 * @property string $time_end
 * @property integer $duration
 * @property string $description
 */
class PresentationTimetables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_timetables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'day_of_week', 'time_start'], 'required'],
            [['presentation_id', 'day_of_week', 'duration'], 'integer'],
            [['time_start', 'time_end'], 'safe'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'day_of_week' => Yii::t('app', 'Day Of Week'),
            'time_start' => Yii::t('app', 'Time Start'),
            'time_end' => Yii::t('app', 'Time End'),
            'duration' => Yii::t('app', 'Duration'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
