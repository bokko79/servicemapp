<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_issues_translation".
 *
 * @property integer $id
 * @property integer $object_issue_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsObjectIssues $objectIssue
 */
class CsObjectIssuesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_issues_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_issue_id', 'lang_code', 'name', 'orig_name'], 'required'],
            [['object_issue_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 120],
            [['orig_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_issue_id' => 'Problem.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena problema (iz tabele service_issues).',
            'orig_name' => 'Originalno ime problema.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIssue()
    {
        return $this->hasOne(CsObjectIssues::className(), ['id' => 'object_issue_id']);
    }

    /**
     * @inheritdoc
     * @return CsObjectIssuesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectIssuesTranslationQuery(get_called_class());
    }
}
