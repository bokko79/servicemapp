<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_issues".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $issue
 * @property string $des
 *
 * @property Presentations $presentation
 */
class PresentationIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'issue'], 'required'],
            [['presentation_id'], 'integer'],
            [['des'], 'string'],
            [['issue'], 'string', 'max' => 64],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentations::className(), 'targetAttribute' => ['presentation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'presentation_id' => 'Presentation ID',
            'issue' => 'Issue',
            'des' => 'Des',
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
