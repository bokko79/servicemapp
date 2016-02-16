<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use frontend\models\Orders;
use frontend\models\OrdersSearch;
use frontend\models\Agreements;
use frontend\models\AgreementsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($username=null)
    {
        $this->layout = '//user_index';

        if(isset($username)) {
            $model = $this->findModelByUsername($username);

            if($model) {
                $csSectors = \frontend\models\CsSectors::find()->all();

                return $this->render('view', [
                    'model' => $model,
                    'csSectors' => $csSectors,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionProfile($username=null)
    {
        $this->layout = '//user_profile';

        if(isset($username)) {
            $model = $this->findModelByUsername($username);

            if($model) {
                $csSectors = \frontend\models\CsSectors::find()->all();

                return $this->render('profile', [
                    'model' => $model,
                    'csSectors' => $csSectors,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionOrders($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $model = $user->activities;
                $searchModel = new OrdersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $dataProvider->pagination = [
                    'defaultPageSize' => 10,
                    'pageSizeLimit' => [10, 100],
                ];

                return $this->render('orders', [
                    'model' => $user,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionSavedOrders($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $model = $user->activities;
                $searchModel = new OrdersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('saved-orders', [
                    'model' => $user,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionArrangements($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $searchModel = new AgreementsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('arrangements', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $user,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }    

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionFinances($username=null)
    {
        $this->layout = '//finances';

        if(isset($username)) {
            $model = $this->findModelByUsername($username);

            if($model) {
                $csSectors = \frontend\models\CsSectors::find()->all();

                return $this->render('finances', [
                    'model' => $model,
                    'csSectors' => $csSectors,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }
    

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($username=null)
    {
        $this->layout = '//settings';

        if(isset($username)) {
            $model = $this->findModelByUsername($username);

            if($model) {               
                
                $details = $model->userDetails;
                $filters = ($model->userFilters) ? $model->userFilters : new \frontend\models\UserFilters;
                $images = $model->userImages;
                $notifications = $model->userNotifications;
                $notificationsSms = $model->userNotificationsSms;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'details' => $details,
                        'filters' => $filters,
                        'images' => $images,
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }          
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionAccount($username=null)
    {
        $this->layout = '//settings';

        if(isset($username)) {
            $model = $this->findModelByUsername($username);

            if($model) {               
                
                $details = $model->userDetails;
                $filters = ($model->userFilters) ? $model->userFilters : new \frontend\models\UserFilters;
                $images = $model->userImages;
                $notifications = $model->userNotifications;
                $notificationsSms = $model->userNotificationsSms;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('account', [
                        'model' => $model,
                        'details' => $details,
                        'filters' => $filters,
                        'images' => $images,
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }          
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByUsername($username)
    {
        if (($model = User::find()->where('username=:username', [':username'=>$username])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
