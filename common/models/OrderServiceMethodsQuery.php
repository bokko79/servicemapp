<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrderServiceMethods]].
 *
 * @see OrderServiceMethods
 */
class OrderServiceMethodsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderServiceMethods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderServiceMethods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}