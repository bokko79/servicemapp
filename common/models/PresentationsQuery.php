<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Presentations]].
 *
 * @see Presentations
 */
class PresentationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Presentations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Presentations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}