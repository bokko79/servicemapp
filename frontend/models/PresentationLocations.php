<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_locations".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $location_id
 * @property integer $location_within
 * @property string $description
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
            [['presentation_id', 'location_id', 'location_within'], 'integer'],
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
            'location_id' => Yii::t('app', 'Location ID'),
            'location_within' => Yii::t('app', 'Location Within'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
