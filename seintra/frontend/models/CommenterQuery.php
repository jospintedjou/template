<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Commenter]].
 *
 * @see Commenter
 */
class CommenterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Commenter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Commenter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
