<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_term_milestones".
 *
 * @property string $id
 * @property string $provider_term_id
 * @property string $name
 * @property integer $percentage
 * @property string $amount
 * @property string $date
 */
class ProviderTermMilestones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_term_milestones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_term_id', 'name'], 'required'],
            [['provider_term_id', 'percentage'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_term_id' => 'Provider Term ID',
            'name' => 'Name',
            'percentage' => 'Percentage',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }
}
