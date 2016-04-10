<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsServiceUnits]].
 *
 * @see CsServiceUnits
 */
class CsServiceUnitsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsServiceUnits[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsServiceUnits|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
