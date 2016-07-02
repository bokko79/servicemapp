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
 * @property string $name_akk 
 * @property string $name_inst 
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
            [['action_id', 'lang_code', 'name', 'name_akk', 'name_inst'], 'required'],
            [['action_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['name_akk', 'name_inst', 'orig_name'], 'string', 'max' => 64],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => CsLanguages::className(), 'targetAttribute' => ['lang_code' => 'code']],
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
            'name_akk' => Yii::t('app', 'Name Akk'), 
            'name_inst' => Yii::t('app', 'Name Inst'),
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
}
