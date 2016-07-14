<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentations_translation".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $lang_code
 * @property string $title
 * @property string $description
 */
class PresentationsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentations_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'lang_code', 'title', 'description'], 'required'],
            [['presentation_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 256],
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
            'lang_code' => Yii::t('app', 'Lang Code'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
