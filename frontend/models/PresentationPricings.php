<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_pricings".
 *
 * @property integer $id
 * @property integer $presentation_id
 * @property string $correction_type
 * @property integer $constraint_value
 * @property string $price_amount
 * @property integer $price_pct
 */
class PresentationPricings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_pricings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'correction_type', 'constraint_value'], 'required'],
            [['presentation_id', 'constraint_value', 'price_pct'], 'integer'],
            [['correction_type'], 'string'],
            [['price_amount'], 'number'],
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
            'correction_type' => Yii::t('app', 'Correction Type'),
            'constraint_value' => Yii::t('app', 'Constraint Value'),
            'price_amount' => Yii::t('app', 'Price Amount'),
            'price_pct' => Yii::t('app', 'Price Pct'),
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
