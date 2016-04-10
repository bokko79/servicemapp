<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_object_models".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $object_id
 * @property string $description
 */
class CsServiceObjectModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_object_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'object_id'], 'required'],
            [['service_id', 'object_id'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return CsServiceObjectModelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServiceObjectModelsQuery(get_called_class());
    }
}
