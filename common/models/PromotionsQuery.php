<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Promotions]].
 *
 * @see Promotions
 */
class PromotionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Promotions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Promotions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}