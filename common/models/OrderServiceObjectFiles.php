<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_files".
 *
 * @property integer $id
 * @property string $order_service_id
 * @property string $file_id
 *
 * @property Images $image
 * @property OrderServices $orderService
 */
class OrderServiceObjectFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'file_id'], 'required'],
            [['order_service_id', 'file_id'], 'integer'],
            [['type'], 'string'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['order_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderServices::className(), 'targetAttribute' => ['order_service_id' => 'id']],
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
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderServices::className(), ['id' => 'order_service_id']);
    }
}
