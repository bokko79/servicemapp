<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsServiceMethods]].
 *
 * @see CsServiceMethods
 */
class CsServiceMethodsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsServiceMethods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsServiceMethods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
