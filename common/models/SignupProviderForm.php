<?php
namespace common\models;
use common\models\User;
use yii\base\Model;
use Yii;
/**
 * Signup form
 */
class SignupProviderForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $industry;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'targetAttribute' => 'username',  'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
            ['industry', 'required'],
            ['industry', 'integer'],
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
            'industry' => t('Vaša delatnost'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        // user
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->is_provider = 1;
        $user->registered_by = 1;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->generatePasswordResetToken();
        $user->generateEmailResetHash();
        $user->generateActivationHash();
        $user->generateInviteHash();
        $user->generateLoginHash();
        $user->generatePhoneVerificationHash();
        $user->generateRoleCode();

        return ($user->save()) ? $user : null;
        
    }
}