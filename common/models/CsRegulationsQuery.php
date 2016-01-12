<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsRegulations]].
 *
 * @see CsRegulations
 */
class CsRegulationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsRegulations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsRegulations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}