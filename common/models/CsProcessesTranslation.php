<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_processes_translation".
 *
 * @property integer $id
 * @property integer $process_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsProcesses $process
 * @property CsLanguages $langCode
 */
class CsProcessesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_processes_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_id', 'lang_code', 'name', 'orig_name'], 'required'],
            [['process_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'orig_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'process_id' => 'Proces.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena procesa.',
            'orig_name' => 'Originalno ime procesa (iz kolone processes).',
            'description' => 'Tekstualni opis procesa.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(CsProcesses::className(), ['id' => 'process_id']);
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
     * @return CsProcessesTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsProcessesTranslationQuery(get_called_class());
    }
}
