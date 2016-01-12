<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserOrder]].
 *
 * @see UserOrder
 */
class UserOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}