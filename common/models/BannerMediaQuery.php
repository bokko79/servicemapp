<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BannerMedia]].
 *
 * @see BannerMedia
 */
class BannerMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BannerMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BannerMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}