<?php
// app/components/Request.php
namespace frontend\components;


class User extends \yii\web\User
{  
	/**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getUsername()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->username) ? $user->username : null;
    }
}