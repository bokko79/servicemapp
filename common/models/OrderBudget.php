<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_budget".
 *
 * @property string $order_id
 * @property string $budget
 * @property integer $currency_id
 * @property string $budget_opertator
 */
class OrderBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'budget', 'currency_id'], 'required'],
            [['order_id', 'budget', 'currency_id'], 'integer'],
            [['budget_opertator'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'budget' => Yii::t('app', 'Budget'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'budget_opertator' => Yii::t('app', 'Budget Opertator'),
        ];
    }
}
