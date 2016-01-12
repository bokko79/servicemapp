<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Transactions]].
 *
 * @see Transactions
 */
class TransactionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Transactions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Transactions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}