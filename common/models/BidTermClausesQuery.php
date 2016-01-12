<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BidTermClauses]].
 *
 * @see BidTermClauses
 */
class BidTermClausesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BidTermClauses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BidTermClauses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}