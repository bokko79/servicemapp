<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_quantities".
 *
 * @property string $presentation_id
 * @property integer $quantity_constraint
 * @property string $quantity_min
 * @property string $quantity_max
 * @property integer $consumer_constraint
 * @property integer $consumer_min
 * @property integer $consumer_max
 * @property integer $duration
 * @property integer $duration_unit
 * @property string $duration_operator
 */
class PresentationQuantities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_quantities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id'], 'required'],
            [['presentation_id', 'quantity_constraint', 'quantity_min', 'quantity_max', 'consumer_constraint', 'consumer_min', 'consumer_max', 'duration', 'duration_unit'], 'integer'],
            [['duration_operator'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'quantity_constraint' => Yii::t('app', 'Quantity Constraint'),
            'quantity_min' => Yii::t('app', 'Quantity Min'),
            'quantity_max' => Yii::t('app', 'Quantity Max'),
            'consumer_constraint' => Yii::t('app', 'Consumer Constraint'),
            'consumer_min' => Yii::t('app', 'Consumer Min'),
            'consumer_max' => Yii::t('app', 'Consumer Max'),
            'duration' => Yii::t('app', 'Duration'),
            'duration_unit' => Yii::t('app', 'Duration Unit'),
            'duration_operator' => Yii::t('app', 'Duration Operator'),
        ];
    }
}
