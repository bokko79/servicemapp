<?php
namespace common\models;
use common\models\User;
use yii\base\Model;
use Yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => \frontend\models\User::classname(), 'targetAttribute' => 'username',  'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This email address has already been taken.'],
            [['password', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
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
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailResetHash();
        $user->generateActivationHash();        
        $user->generateLoginHash();

        $user->generatePasswordResetToken();
        $user->is_provider = 0;
        $user->registered_by = 1;
        $user->generateInviteHash();
        $user->generatePhoneVerificationHash();
        $user->generateRoleCode();
        $user->created_at = time();
        $user->updated_at = time();        
        
        return $user->save() ? $user : null;
    }
}