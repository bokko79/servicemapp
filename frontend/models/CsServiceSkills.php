<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_service_skills".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $skill_id
 * @property integer $requirement
 */
class CsServiceSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'skill_id'], 'required'],
            [['service_id', 'skill_id', 'requirement', 'readOnly'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'skill_id' => Yii::t('app', 'Skill ID'),
            'requirement' => Yii::t('app', 'Requirement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(CsSkills::className(), ['id' => 'skill_id']);
    }
}
