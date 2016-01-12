<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Activities]].
 *
 * @see Activities
 */
class ActivitiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Activities[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Activities|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}