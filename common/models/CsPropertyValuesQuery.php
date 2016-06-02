<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsPropertyValues]].
 *
 * @see CsPropertyValues
 */
class CsPropertyValuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsPropertyValues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsPropertyValues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
