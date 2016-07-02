<?php
namespace frontend\controllers;

use Yii;
//use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
//use common\models\SignupForm;
//use common\models\SignupProviderForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\models\LoginForm;
use dektrium\user\traits\AjaxValidationTrait;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'blank';

    use AjaxValidationTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'register', 'register-provider', 'membership'],
                'rules' => [
                    [
                        'actions' => ['login', 'register', 'register-provider'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['membership'],
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

        $user = \common\models\User::findOne(Yii::$app->user->id);
        $role = $user ? $user->details->role : null;

        return $this->render('membership', [
                'role' => $role,
            ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionAlert()
    {
        $title = Yii::t('user', 'Your account has been created');

        return $this->render('alert', [
                'title' => $title,
            ]);
    }

    /**
     * Displays the login page.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model'  => $model,
            //'module' => $this->module,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    /*public function actionLogout()
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
    public function actionDeposit()
    {
        $this->layout = '//blank';

        return $this->render('deposit');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionWithdraw()
    {
        $this->layout = '//blank';

        return $this->render('withdraw');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionTransfer()
    {
        $this->layout = '//blank';

        return $this->render('transfer');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionSuggest()
    {
        $this->layout = '//blank';

        return $this->render('suggest');
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionCheckout()
    {
        $this->layout = '//blank';

        return $this->render('checkout');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    /*public function actionSignup()
    {
        $model = new SignupForm();
        $location = new \common\models\Locations();
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
     * Requests password reset.
     *
     * @return mixed
     */
    /*public function actionRequestPasswordReset()
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
    /*public function actionResetPassword($token)
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
    }*/

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionLanguage()
    {
        $language = Yii::$app->request->get('language');
        Yii::$app->language = $language;

        $languageCookie = new \yii\web\Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($languageCookie);

        if(!Yii::$app->user->isGuest){
            $user = \common\models\User::findOne(Yii::$app->user->id);
            $user->details->lang_code = $language;
            $user->save();
        }
            
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays search result page.
     *
     * @return mixed
     */
    public function actionCurrency()
    {
        $currency = Yii::$app->request->get('currency');
        //Yii::$app->currency = $currency;

        $currencyCookie = new \yii\web\Cookie([
            'name' => 'currency',
            'value' => $currency,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($currencyCookie);

        if(!Yii::$app->user->isGuest){
            $user = \common\models\User::findOne(Yii::$app->user->id);
            $user->details->currency_id = $currency;
            $user->save();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {
        /** @var RegistrationForm $model */
        $model = new \frontend\models\RegistrationUserForm();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && ($user = $model->register())) {
            Yii::$app->user->login($user, Yii::$app->getModule('user')->rememberFor);
            return $this->redirect('/'.$user->username.'/home');
        }

        return $this->render('register', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

    /**
     * Displays the registration page for providers.
     * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegisterProvider()
    { 
        /** @var RegistrationForm $model */
        $model = new \frontend\models\RegistrationProviderForm();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && ($user = $model->register())) {
            Yii::$app->user->login($user, Yii::$app->getModule('user')->rememberFor);
            return $this->redirect('/'.$user->username.'/home');          
        }

        return $this->render('register-provider', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

    
    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->findUser($id);

        /*if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }*/

        if($user and $user->attemptConfirmation($code)){
            switch ($user->type) {
                case 2:
                    $order = $this->findOrder($user->id);
                    $order->status = 'active';
                    $order->save();
                    $this->redirect('/order/'.$order->id);
                    break;
                case 3:
                    $agreement = $this->findAgreement($user->id);
                    $agreement->status = 'active';
                    $agreement->save();
                    $this->redirect('/agreement/'.$agreement->id);
                    break;
                case 4:
                    $presentation = $this->findPresentation($user->id);
                    $presentation->status = 'active';
                    $presentation->service = $this->findService($presentation->service_id);
                    $presentation->save();
                    $this->redirect('/presentation/'.$presentation->id);
                    break;
                case 5:
                    $bid = $this->findBid($user->id);
                    $bid->status = 'active';
                    $bid->save();
                    $this->redirect('/order/'.$bid->order_id);
                    break;
                
                default:
                    $this->redirect('/'.$user->username);
                    break;
            }            
        }

        $this->redirect('/'.$user->username);
    }

    /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findUser($id)
    {
        if (($model = \common\models\User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
   /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findService($id)
    {
        if (($model = \common\models\CsServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findOrder($id) {   
        if($activity = \common\models\Activities::find()->where(['activity' => 'order', 'user_id' => $id])->one()){
            if($order = \common\models\Orders::find()->where(['activity_id' => $activity->id])->one()){
                return $order;
            }
        }
        return null;
    }

    public function findAgreement($id) {
        if($activity = \common\models\Activities::find()->where(['activity' => 'agreement', 'user_id' => $id])->one()){
            if($agreement = \common\models\Agreements::find()->where(['activity_id' => $activity->id])->one()){
                return $agreement;
            }
        }
        return null;
    }

    public function findPresentation($id) {
        if($activity = \common\models\Activities::find()->where(['activity' => 'presentation', 'user_id' => $id])->one()){
            if($presentation = \common\models\Presentations::find()->where(['activity_id' => $activity->id])->one()){
                return $presentation;
            }
        }
        return null;
    }

    public function findBid($id) {
        if($activity = \common\models\Activities::find()->where(['activity' => 'bid', 'user_id' => $id])->one()){
            if($bid = \common\models\Bids::find()->where(['activity_id' => $activity->id])->one()){
                return $bid;
            }
        }
        return null;
    }
    
}
