<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrderServices]].
 *
 * @see OrderServices
 */
class OrderServicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}