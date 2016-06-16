<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Bookings]].
 *
 * @see Bookings
 */
class BookingsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Bookings[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Bookings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}