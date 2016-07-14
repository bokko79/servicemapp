<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_locations".
 *
 * @property string $presentation_id
 * @property string $location_id
 * @property string $destination_id
 * @property integer $coverage
 * @property string $coverage_within
 */
class PresentationLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'location_id'], 'required'],
            [['presentation_id', 'location_id', 'destination_id', 'coverage'], 'integer'],
            [['coverage_within'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'destination_id' => Yii::t('app', 'Destination ID'),
            'coverage' => Yii::t('app', 'Coverage'),
            'coverage_within' => Yii::t('app', 'Coverage Within'),
        ];
    }
}
