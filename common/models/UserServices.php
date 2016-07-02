<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_services".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $service_id
 * @property integer $industry_id
 *
 * @property CsServices $service
 * @property CsIndustries $industry
 * @property User $user
 */
class UserServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'industry_id'], 'required'],
            [['user_id', 'service_id', 'industry_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
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
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
