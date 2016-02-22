<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_service_objectmodels".
 *
 * @property string $id
 * @property string $order_service_id
 * @property integer $object_id
 * @property string $description
 */
class OrderServiceObjectmodels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_objectmodels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'object_id'], 'required'],
            [['order_service_id', 'object_id'], 'integer'],
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
            'order_service_id' => Yii::t('app', 'Order Service ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
