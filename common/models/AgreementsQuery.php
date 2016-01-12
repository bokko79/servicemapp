<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Agreements]].
 *
 * @see Agreements
 */
class AgreementsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Agreements[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Agreements|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}