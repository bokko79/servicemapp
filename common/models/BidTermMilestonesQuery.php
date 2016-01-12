<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BidTermMilestones]].
 *
 * @see BidTermMilestones
 */
class BidTermMilestonesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BidTermMilestones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BidTermMilestones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}