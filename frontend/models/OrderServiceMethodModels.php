<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_service_method_models".
 *
 * @property string $id
 * @property string $order_service_method_id
 * @property string $method_model
 * @property string $description
 */
class OrderServiceMethodModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_method_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_service_method_id', 'method_model'], 'required'],
            [['id', 'order_service_method_id', 'method_model'], 'integer'],
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
            'order_service_method_id' => Yii::t('app', 'Order Service Method ID'),
            'method_model' => Yii::t('app', 'Method Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceMethod()
    {
        return $this->hasOne(OrderServiceMethods::className(), ['id' => 'order_service_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'method_model']);
    }
}
