<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsAttributes]].
 *
 * @see CsAttributes
 */
class CsAttributesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsAttributes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsAttributes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}