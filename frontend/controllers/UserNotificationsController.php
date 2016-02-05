<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UserNotifications;
use frontend\models\UserNotificationsSms;
use frontend\models\UserNotificationsSearch;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserNotificationsController implements the CRUD actions for UserNotifications model.
 */
class UserNotificationsController extends Controller
{
    public $layout='settings';
    
    public function behaviors()
    {
        return [];
    }

    /**
     * Updates an existing UserNotifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($username=null)
    {
        if (isset($username)) {
            $user = \frontend\models\User::find()->where(['username'=>$username])->one();
        }

        if($user) {

            $model = UserNotifications::find()->where('user_id=:user_id', [':user_id'=>$user->id])->one();
            $modelSms = UserNotificationsSMs::find()->where('user_id=:user_id', [':user_id'=>$user->id])->one();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'modelSms' => $modelSms,
                ]);
            }
        } else {
            $this->redirect(Yii::$app->request->baseUrl.'/providers');
        }
    }

    /**
     * Finds the UserNotifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserNotifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserNotifications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
