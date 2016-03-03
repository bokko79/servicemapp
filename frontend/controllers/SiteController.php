<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;
use common\models\SignupProviderForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'home';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays membership page.
     *
     * @return mixed
     */
    public function actionMembership()
    {
        $this->layout = '//settings';

        $user = \frontend\models\User::findOne(Yii::$app->user->id);
        $role = $user->userDetails->role;

        return $this->render('membership', [
                'role' => $role,
            ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->goHome();
            /*return $this->render('login', [
                'model' => $model,
            ]);*/
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $this->layout = '//index_post';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionInvite()
    {
        $this->layout = '//forms';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('invite', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->layout = '//index_post';

        return $this->render('about');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        $this->layout = '//search';

        return $this->render('search');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionDeposit()
    {
        $this->layout = '//finances';

        return $this->render('deposit');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionWithdraw()
    {
        $this->layout = '//finances';

        return $this->render('withdraw');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $location = new \frontend\models\Locations();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && ($user = $model->signup())) {      
            if($this->saveUser($location, $user, $model)){
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goBack();
                }
                return $this->goBack();                    
            }
            return $this->goBack();            
        }
        return $this->goBack();
    }

    /**
     * Signs provider up.
     *
     * @return mixed
     */
    public function actionSignprovider()
    {
        $model = new SignupProviderForm();
        $location = new \frontend\models\Locations();
        if ($model->load(Yii::$app->request->post()) && ($user = $model->signup())) {            
            if($this->saveProvider($location, $user, $model)){
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('/'.$user->username.'/home');
                }
                return $this->goBack();
            }
            return $this->goBack();
        }
        return $this->goBack();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    protected function saveUser($location, $user, $model)
    {
        if($location->load(Yii::$app->request->post())){
            $location->user_id = $user->id;
            if($location->save()){
                $user_location = new \frontend\models\UserLocations();
                $user_location->loc_id=$location->id;
                $user_location->user_id=$user->id;
                $user_location->save();
                // user details
                $userDetails = new \frontend\models\UserDetails();
                $userDetails->user_id = $user->id;
                $userDetails->loc_id = $location->id;
                $userDetails->image_id = 2;
                $userDetails->lang_code = 'SR';
                $userDetails->currency_id = 1;
                $userDetails->role_id = 1;
                $userDetails->time_role_set = date('Y-m-d H:i:s');
                $userDetails->update_time = date('Y-m-d H:i:s');
                $userDetails->save();
                // user notifications
                $userNotifications = new \frontend\models\UserNotifications();
                $userNotifications->user_id = $user->id;
                $userNotifications->update_time = date('Y-m-d H:i:s');
                $userNotifications->save();
                // user notificationsSMS
                $userNotificationsSMS = new \frontend\models\UserNotificationsSms();
                $userNotificationsSMS->user_id = $user->id;
                $userNotificationsSMS->update_time = date('Y-m-d H:i:s');
                $userNotificationsSMS->save();
                // user log
                $userLog = new \frontend\models\UserLog();
                $userLog->user_id = $user->id;
                $userLog->action = 'provider_registered';
                $userLog->alias = $user->id;
                $userLog->time = date('Y-m-d H:i:s');
                $userLog->save();
                
                return true;
            } else {
                return false;
            }
        }  
        return false;
    }

    protected function saveProvider($location, $user, $model)
    {
        if($this->saveUser($location, $user, $model)){            
            // provider
            $provider = new \frontend\models\Provider();
            $provider->user_id = $user->id;
            $provider->industry_id = $model->industry;
            $provider->registration_time = date('Y-m-d H:i:s');
            if($provider->save()){
                // provider Industry
                $providerIndustry = new \frontend\models\ProviderIndustries();
                $providerIndustry->provider_id = $provider->id;
                $providerIndustry->industry_id = $model->industry;
                $providerIndustry->main = 1;
                $providerIndustry->save();
                // provider Language
                $providerLanguage = new \frontend\models\ProviderLanguages();
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
                $providerTerms->update_time = date('Y-m-d H:i:s');
                $providerTerms->save();

                return true;

            } else {
                return false;
            }
        }  
        return false;
    }
}
