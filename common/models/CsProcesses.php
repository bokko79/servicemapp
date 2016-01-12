<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_processes".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $service_count
 * @property string $description
 *
 * @property CsProcessesTranslation[] $csProcessesTranslations
 * @property CsServiceProcesses[] $csServiceProcesses
 * @property Orders[] $orders
 */
class CsProcesses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_processes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'service_count'], 'required'],
            [['type', 'description'], 'string'],
            [['service_count'], 'integer'],
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
            'name' => 'Ime procesa.',
            'type' => 'Vrsta procesa. process - raznorodne delatnosti i predmeti usluge; operation - raznorodne delatnosti nad istim predmetom usluge.',
            'service_count' => 'Broj usluga u okviru procesa.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsProcessesTranslations()
    {
        return $this->hasMany(CsProcessesTranslation::className(), ['process_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['process_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['process_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsProcessesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsProcessesQuery(get_called_class());
    }
}
