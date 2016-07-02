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
class RegistrationProviderForm extends BaseForm
{
    /**
     * @var string User email address
     */
    public $email;

    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string Password
     */
    public $password;
    public $password_repeat;

    /**
     * @var integer Industry
     */
    public $industry;

    /**
     * @var integer registration_type
     */
    public $registration_type;

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
    public function init()
    {
        $this->module = Yii::$app->getModule('user');
    }

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
            [['username', 'email', 'password'], 'required', 'when' => function ($model) {
                return $model->checker == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('input[name=\"registerProvider-form[checker]\"]').val() == 1;
            }", 'on'=>'presentation'],
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
            //'passwordRepeatRequired'   => ['password_repeat', 'required'],
            //'passwordRepeat'   => ['password_repeat', 'compare', 'compareAttribute'=>'password'],
            // industry
            'industryRequired' => ['industry', 'required'],
            'industryPattern' => ['industry', 'integer'],
            'registrationType' => ['registration_type', 'integer'],
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
            'industry' => t('Pretežna delatnost'),
            'type' => t('Vrsta registracije'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'register-provider-form';
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
    protected function loadAttributes(User $user)
    {
        $user->setAttributes($this->attributes);
        $user->generatePasswordResetToken();
        $user->is_provider = 1;
        $user->type = $this->registration_type;
        $user->registered_by();
        $user->generateInviteHash();
        $user->generatePhoneVerificationHash();
        $user->generateRoleCode();
        $user->created_at = time();
        $user->updated_at = time();
        $user->status = 20;
    }
}
