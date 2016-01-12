<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSectors]].
 *
 * @see CsSectors
 */
class CsSectorsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSectors[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSectors|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}