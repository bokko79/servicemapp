<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSkills]].
 *
 * @see CsSkills
 */
class CsSkillsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSkills[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSkills|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}