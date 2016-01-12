<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BidTermExpenses]].
 *
 * @see BidTermExpenses
 */
class BidTermExpensesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BidTermExpenses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BidTermExpenses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}