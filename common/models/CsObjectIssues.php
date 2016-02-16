<?php

namespace common\models;

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
            'id' => 'ID',
            'object_id' => 'Usluga.',
            'issue' => 'Problem. (Problem koji ima korisnik, a koji se rešava ovom uslugom).',
            'type' => 'Pomoćna kolona.',
            'description' => 'Opis stavke.',
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
    public function getT()
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

    /**
     * @inheritdoc
     * @return CsObjectIssuesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectIssuesQuery(get_called_class());
    }
}
