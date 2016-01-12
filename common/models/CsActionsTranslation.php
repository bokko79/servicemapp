<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_actions_translation".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsActions $action
 * @property CsLanguages $langCode
 */
class CsActionsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_actions_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'lang_code', 'name'], 'required'],
            [['action_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
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
            'action_id' => 'Akcija usluge.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena akcije usluge,',
            'orig_name' => 'Originalno ime akcije usluge (iz tabele actions).',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @inheritdoc
     * @return CsActionsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsActionsTranslationQuery(get_called_class());
    }
}
