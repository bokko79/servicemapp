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
    public $location;
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
            ['password', 'compare'],
            //['location', 'required'],
            //['location', 'integer'],
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
        $user->setPassword($this->password);
        $user->email = $this->email;        
        $user->fullname = c($this->username);
        $user->is_provider = 1;
        $user->ip_address = 1;
        $user->registered_by = 1;
        $user->created_at = date('U');
        $user->updated_at = date('U');

        $user->auth_key = Yii::$app->security->generateRandomString();
        //$user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->password_reset_token = c($this->username);
        $user->email_reset_hash = Yii::$app->security->generateRandomString();
        $user->activation_hash = Yii::$app->security->generateRandomString();
        $user->invite_hash = Yii::$app->security->generateRandomString();
        $user->login_hash = Yii::$app->security->generateRandomString();
        $user->phone_verification_hash = substr(str_shuffle(str_repeat("0123456789", 4)), 0, 4);
        $user->role_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 13)), 0, 13);

        return ($user->save()) ? $user : null;
        /*if($user->save()){
            // location
            $location = $this->location;
            if($location->load(Yii::$app->request->post())){
                $location->user_id = $user->id;
                if($location->save()){
                    // user locations
                    $user_location = new \frontend\models\UserLocations();
                    $user_location->loc_id=$location->id;
                    $user_location->user_id=$user->id;
                    $user_location->save();
                    // user details
                    $userDetails = new \frontend\models\UserDetails();
                    $userDetails->user_id = $user->id;
                    $userDetails->loc_id = $location->id;
                    $userDetails->update_time = now();
                    $userDetails->save();
                    // user notifications
                    $userNotifications = new \frontend\models\UserNotifications();
                    $userNotifications->user_id = $user->id;
                    $userNotifications->update_time = now();
                    $userNotifications->save();
                    // user notificationsSMS
                    $userNotificationsSMS = new \frontend\models\UserNotificationsSms();
                    $userNotificationsSMS->user_id = $user->id;
                    $userNotificationsSMS->update_time = now();
                    $userNotificationsSMS->save();
                    // user log
                    $userLog = new \frontend\models\UserLog();
                    $userLog->user_id = $user->id;
                    $userLog->action = 'provider_registered';
                    $userLog->alias = $user->id;
                    $userLog->time = now();
                    $userLog->save();
                    // provider
                    $provider = new \frontend\models\Provider();
                    $provider->user_id = $user->id;
                    $provider->industry_id = $this->industry;
                    $provider->registration_time = now();
                    if($provider->save()){
                        // provider Industry
                        $providerIndustry = new \frontend\models\ProviderIndustries();
                        $providerIndustry->provider_id = $provider->id;
                        $providerIndustry->industry_id = $this->industry;
                        $providerIndustry->main = 1;
                        $providerIndustry->save();
                        // provider Language
                        $providerLanguage = new \frontend\models\ProviderLanguage();
                        $providerLanguage->provider_id = $provider->id;
                        $providerLanguage->lang_code = 'SR';
                        $providerLanguage->save();
                        // provider Portfolio
                        $providerPortfolio = new \frontend\models\ProviderPortfolio();
                        $providerPortfolio->provider_id = $provider->id;
                        $providerPortfolio->name = 'Moj portfolio';
                        $providerPortfolio->save();
                        // provider Terms
                        $providerTerms = new \frontend\models\ProviderTerms();
                        $providerTerms->provider_id = $provider->id;
                        $providerTerms->update_time = now();
                        $providerTerms->save();

                        return $user;

                    } else {
                        return null;
                    }                        
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }*/
    }
}