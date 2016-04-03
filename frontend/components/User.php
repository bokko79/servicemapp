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

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getLocation()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \frontend\models\User::findOne($identity->getId());
            return ($user->location) ? $user->location : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getLocationLat()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \frontend\models\User::findOne($identity->getId());
            return ($user->location) ? $user->location->lat : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getLocationLng()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \frontend\models\User::findOne($identity->getId());
            return ($user->location) ? $user->location->lng : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getRole()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \frontend\models\User::findOne($identity->getId());
            return ($user->details) ? $user->details->role->name : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getCurrency()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \frontend\models\User::findOne($identity->getId());
            return ($user->details) ? $user->details->currency->code : 'RSD';
        }

        return 'RSD';
    }
}