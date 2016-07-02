<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_term_milestones".
 *
 * @property string $id
 * @property string $provider_term_id
 * @property string $name
 * @property integer $percentage
 * @property string $amount
 * @property string $date
 */
class PresentationTermMilestones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_term_milestones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_term_id', 'name'], 'required'],
            [['presentation_term_id', 'percentage'], 'integer'],
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
            'presentation_term_id' => 'Presentation Term ID',
            'name' => 'Name',
            'percentage' => 'Percentage',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationTerm()
    {
        return $this->hasOne(PresentationTerms::className(), ['presentation_id' => 'presentation_term_id']);
    }
}
