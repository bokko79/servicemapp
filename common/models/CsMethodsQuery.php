<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsMethods]].
 *
 * @see CsMethods
 */
class CsMethodsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsMethods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsMethods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}