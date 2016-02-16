<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsProperties]].
 *
 * @see CsProperties
 */
class CsPropertiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsProperties[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsProperties|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}