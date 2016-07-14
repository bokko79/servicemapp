<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_locations".
 *
 * @property string $order_id
 * @property string $location_id
 * @property string $destination_id
 * @property integer $coverage
 * @property integer $coverage_within
 */
class OrderLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'location_id'], 'required'],
            [['order_id', 'location_id', 'destination_id', 'coverage', 'coverage_within'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'destination_id' => Yii::t('app', 'Destination ID'),
            'coverage' => Yii::t('app', 'Coverage'),
            'coverage_within' => Yii::t('app', 'Coverage Within'),
        ];
    }
}
