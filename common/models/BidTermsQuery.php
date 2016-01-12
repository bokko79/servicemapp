<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BidTerms]].
 *
 * @see BidTerms
 */
class BidTermsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BidTerms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BidTerms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}