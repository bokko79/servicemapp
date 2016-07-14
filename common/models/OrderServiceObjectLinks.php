<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_links".
 *
 * @property string $id
 * @property string $order_service_id
 * @property string $link
 * @property string $type
 */
class OrderServiceObjectLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'link'], 'required'],
            [['order_service_id'], 'integer'],
            [['type'], 'string'],
            [['link'], 'string', 'max' => 256],
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
            'link' => Yii::t('app', 'Link'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
