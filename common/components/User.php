<?php
// app/components/Request.php
namespace common\components;


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
            $user = \common\models\User::findOne($identity->getId());
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
            $user = \common\models\User::findOne($identity->getId());
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
            $user = \common\models\User::findOne($identity->getId());
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
            $user = \common\models\User::findOne($identity->getId());
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
            $user = \common\models\User::findOne($identity->getId());
            return ($user->details) ? $user->details->currency->code : 'RSD';
        }

        return 'RSD';
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getAvatar()
    {
        $identity = $this->getIdentity();        
        $avatar = '@frontend-images/users/default_avatar.jpg';

        if($identity !== null) {
            $user = \common\models\User::findOne($identity->getId());
            if($user->details and $user->details->file){
                $avatar = '@frontend-images/users/thumbs/'.$user->details->file->ime;
            }
        }

        return \yii\helpers\Html::img($avatar, ['class' => 'img-responsive img-rounded']);
    }

    /** @inheritdoc */
    public function afterLogin($identity, $cookieBased, $duration)
    {
        $identity = $this->getIdentity();  
        if($identity !== null) {
            $user = \common\models\User::findOne($identity->getId());
            $user->login_count++;
            $user->logged_in_at = time();
            $user->logged_in_from = \Yii::$app->request->userIP;
            $user->update();
        }        

        return parent::afterLogin($identity, $cookieBased, $duration);
    }
}