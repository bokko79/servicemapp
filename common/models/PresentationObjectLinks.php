<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_object_links".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $link
 * @property string $type
 */
class PresentationObjectLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'link'], 'required'],
            [['presentation_id'], 'integer'],
            [['type'], 'string'],
            [['link'], 'string', 'max' => 256],
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
            'link' => Yii::t('app', 'Link'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
