<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Banners]].
 *
 * @see Banners
 */
class BannersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Banners[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Banners|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}