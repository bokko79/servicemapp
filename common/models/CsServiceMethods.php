<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_methods".
 *
 * @property string $id
 * @property integer $service_id
 * @property integer $method_id
 * @property integer $requirement
 */
class CsServiceMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'method_id'], 'required'],
            [['service_id', 'method_id', 'requirement'], 'integer'],
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
            'method_id' => Yii::t('app', 'Method ID'),
            'requirement' => Yii::t('app', 'Requirement'),
        ];
    }

    /**
     * @inheritdoc
     * @return CsServiceMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServiceMethodsQuery(get_called_class());
    }
}
