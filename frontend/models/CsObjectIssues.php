<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_issues".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $issue
 * @property integer $type
 * @property string $description
 *
 * @property CsObjects $object
 * @property CsObjectIssuesTranslation[] $csObjectIssuesTranslations
 * @property OrderServiceIssues[] $orderServiceIssues
 */
class CsObjectIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'issue'], 'required'],
            [['object_id', 'type'], 'integer'],
            [['description'], 'string'],
            [['issue'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'issue' => Yii::t('app', 'Issue'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectIssuesTranslations()
    {
        return $this->hasMany(CsObjectIssuesTranslation::className(), ['object_issue_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceIssues()
    {
        return $this->hasMany(OrderServiceIssues::className(), ['object_issue_id' => 'id']);
    }
}
