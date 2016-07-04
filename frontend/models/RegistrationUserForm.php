<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\models;

use dektrium\user\models\RegistrationForm as BaseForm;

use dektrium\user\Module;
use Yii;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationUserForm extends BaseForm
{
    /**
     * @var string Password
     */
    public $password_repeat;

    /**
     * @var checker checker
     */
    public $checker;

    /**
     * @var Module
     */
    protected $module;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $user = $this->module->modelMap['User'];

        return [
            // username rules
            'usernameLength'   => ['username', 'string', 'min' => 4, 'max' => 25],
            'usernameTrim'     => ['username', 'filter', 'filter' => 'trim'],
            'usernamePattern'  => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required', 'message' => Yii::t('user', 'Korisničko ime je obavezno')],
            'usernameUnique'   => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'Ovo korisničko ime je već zauzeto')
            ],
            // email rules
            'emailTrim'     => ['email', 'filter', 'filter' => 'trim'],
            'emailRequired' => ['email', 'required', 'message' => Yii::t('user', 'E-mail adresa je obavezna')],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'Ova e-mail adresa je već zauzeta'),
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength'   => ['password', 'string', 'min' => 6],
            'passwordRepeatRequired'   => ['password_repeat', 'required', 'message' => Yii::t('user', 'Ponovljena lozinka je obavezna')],
            'passwordRepeat'   => ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('user', 'Ponovljena lozinka mora biti jednaka lozinci')],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => t('Korisničko ime'),
            'password' => t('Lozinka'),
            'password_repeat' => t('Ponovite lozinku'),
            'email' => t('E-mail adresa'),
            'location' => t('Lokacija'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'register-form';
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = new \common\models\User();
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'info',
            Yii::t('user', 'Sjajno! Vaš nalog je napravljen! Međutim, potrebno je da potvrdite Vaš identitet jednostavnim klikom na aktivacioni link. Poruka sa aktivacionim linkom je poslata na Vaš e-mail.')
        );

        return $user;
    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(\common\models\User $user)
    {
        $user->setAttributes($this->attributes);
        $user->generatePasswordResetToken();
        $user->is_provider = 0;
        $user->registered_by();
        $user->generateInviteHash();
        $user->generatePhoneVerificationHash();
        $user->generateRoleCode();
        $user->created_at = time();
        $user->updated_at = time();
        $user->status = 20;
    }


    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function temporary()
    {
        /** @var User $user */
        $user = new \common\models\User();

        $user->username = 'temp_'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->password_hash = Yii::$app->security->generateRandomString() . '_' . time();
        $user->password = Yii::$app->security->generateRandomString() . '_' . time();
        $user->email = Yii::$app->security->generateRandomString().'@'.substr(str_shuffle(str_repeat("abcdefghijklmnopq", 4)), 0, 4).'.com';
        $user->generatePasswordResetToken();
        $user->is_provider = 0;
        $user->registered_by();
        $user->generateInviteHash();
        $user->generatePhoneVerificationHash();
        $user->generateRoleCode();
        $user->created_at = time();
        $user->updated_at = time();
        $user->status = 10;

        if (!$user->temporary()) {
            return false;
        }        

        return $user;
    }
}
