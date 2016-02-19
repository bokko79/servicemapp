<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_skills".
 *
 * @property string $id
 * @property string $order_id
 * @property integer $skill_id
 * @property string $description
 */
class OrderSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'skill_id'], 'required'],
            [['order_id', 'skill_id'], 'integer'],
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
            'order_id' => Yii::t('app', 'Order ID'),
            'skill_id' => Yii::t('app', 'Skill ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
