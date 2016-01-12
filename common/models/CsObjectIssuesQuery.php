<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectIssues]].
 *
 * @see CsObjectIssues
 */
class CsObjectIssuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsObjectIssues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectIssues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}