<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\controllers;

use dektrium\user\models\User;
use dektrium\user\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\web\Response;
use dektrium\user\Module;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends \dektrium\user\controllers\RegistrationController
{
    use AjaxValidationTrait;

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['register', 'register-provider', 'connect'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['confirm', 'resend'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->module = Yii::$app->getModule('user');
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
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }
        $this->layout = '/blank';

        /** @var RegistrationForm $model */
        $model = new \frontend\models\RegistrationUserForm();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && ($user = $model->register())) {
            Yii::$app->user->login($user, Yii::$app->getModule('user')->rememberFor);
            return $this->redirect('/'.$user->username.'/home');
        }
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
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }
        $this->layout = '/blank';

        /** @var RegistrationForm $model */
        $model = new \frontend\models\RegistrationProviderForm();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && ($user = $model->register())) {
            Yii::$app->user->login($user, Yii::$app->getModule('user')->rememberFor);
            return $this->redirect('/'.$user->username.'/home');          
        }
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
