<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_links".
 *
 * @property string $id
 * @property string $user_object_id
 * @property string $link
 * @property string $type
 */
class UserObjectLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'link'], 'required'],
            [['user_object_id'], 'integer'],
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
            'user_object_id' => Yii::t('app', 'User Object ID'),
            'link' => Yii::t('app', 'Link'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
