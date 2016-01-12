<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrderServiceSpecs]].
 *
 * @see OrderServiceSpecs
 */
class OrderServiceSpecsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderServiceSpecs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderServiceSpecs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}