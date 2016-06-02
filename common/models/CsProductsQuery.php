<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsProducts]].
 *
 * @see CsProducts
 */
class CsProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsProducts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsProducts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
