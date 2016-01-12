<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Locations]].
 *
 * @see Locations
 */
class LocationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Locations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Locations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}