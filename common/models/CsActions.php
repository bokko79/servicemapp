<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_actions".
 *
 * @property integer $id
 * @property string $name
 * @property integer $object_mode
 * @property string $status
 * @property string $added_by
 * @property string $added_time
 * @property string $description
 *
 * @property User $addedBy
 * @property CsActionsTranslation[] $csActionsTranslations
 * @property CsMethods[] $csMethods
 * @property CsServices[] $csServices
 */
class CsActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['object_mode', 'added_by'], 'integer'],
            [['status', 'description'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Akcija usluge.',
            'object_mode' => 'Parametar koji označava da li akcija sadrži više usluga. 0 - Akcija ima samo jednu  uslugu; 1 - Akcija ima više od jedne usluge.',
            'status' => 'Status aktivnosti.',
            'added_by' => 'Korisnik koji je uneo aktivnost.',
            'added_time' => 'Vreme unošenja aktivnosti.',
            'description' => 'Opis akcije.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsActionsTranslation::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsMethods()
    {
        return $this->hasMany(CsMethods::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServices()
    {
        return $this->hasMany(CsServices::className(), ['action_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsActionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsActionsQuery(get_called_class());
    }
}
