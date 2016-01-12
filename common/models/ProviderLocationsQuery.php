<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderLocations]].
 *
 * @see ProviderLocations
 */
class ProviderLocationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderLocations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderLocations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}