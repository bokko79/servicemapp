<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsUnits]].
 *
 * @see CsUnits
 */
class CsUnitsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsUnits[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsUnits|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}