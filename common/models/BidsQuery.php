<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Bids]].
 *
 * @see Bids
 */
class BidsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Bids[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Bids|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}