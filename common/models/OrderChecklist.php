<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_checklist".
 *
 * @property string $order_id
 * @property integer $industry_properties
 * @property integer $quantities
 * @property integer $locations
 * @property integer $times
 * @property integer $budget
 * @property integer $advanced
 * @property integer $notifications
 * @property integer $terms
 */
class OrderChecklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'industry_properties', 'quantities', 'locations', 'times', 'budget', 'advanced', 'notifications', 'terms'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'industry_properties' => Yii::t('app', 'Industry Properties'),
            'quantities' => Yii::t('app', 'Quantities'),
            'locations' => Yii::t('app', 'Locations'),
            'times' => Yii::t('app', 'Times'),
            'budget' => Yii::t('app', 'Budget'),
            'advanced' => Yii::t('app', 'Advanced'),
            'notifications' => Yii::t('app', 'Notifications'),
            'terms' => Yii::t('app', 'Terms'),
        ];
    }
}
