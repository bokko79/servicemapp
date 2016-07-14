<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_checklist".
 *
 * @property string $order_service_id
 * @property integer $object_container
 * @property integer $object_models
 * @property integer $object_properties
 * @property integer $object_files
 * @property integer $object_issues
 * @property integer $action_properties
 */
class OrderServiceChecklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id'], 'required'],
            [['order_service_id', 'object_container', 'object_models', 'object_properties', 'object_files', 'object_issues', 'action_properties'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_service_id' => Yii::t('app', 'Order Service ID'),
            'object_container' => Yii::t('app', 'Object Container'),
            'object_models' => Yii::t('app', 'Object Models'),
            'object_properties' => Yii::t('app', 'Object Properties'),
            'object_files' => Yii::t('app', 'Object Files'),
            'object_issues' => Yii::t('app', 'Object Issues'),
            'action_properties' => Yii::t('app', 'Action Properties'),
        ];
    }
}
