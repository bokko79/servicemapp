<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Offers]].
 *
 * @see Offers
 */
class OffersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Offers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Offers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}