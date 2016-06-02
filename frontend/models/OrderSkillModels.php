<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_skill_models".
 *
 * @property string $id
 * @property string $order_skill_id
 * @property string $skill_model
 * @property string $description
 */
class OrderSkillModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_skill_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_skill_id', 'skill_model'], 'required'],
            [['id', 'order_skill_id', 'skill_model'], 'integer'],
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
            'order_skill_id' => Yii::t('app', 'Order Skill ID'),
            'skill_model' => Yii::t('app', 'Skill Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSkill()
    {
        return $this->hasOne(OrderSkills::className(), ['id' => 'order_skill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'skill_model']);
    }
}
