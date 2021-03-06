<?php

namespace frontend\controllers;

use Yii;
use common\models\Provider;
use common\models\ProviderSearch;
use common\models\User;
use common\models\Bids;
use common\models\BidsSearch;
use common\models\Presentations;
use common\models\PresentationsSearch;
use common\models\Promotions;
use common\models\PromotionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProviderController implements the CRUD actions for Provider model.
 */
class ProviderController extends Controller
{
    public $layout='index';

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
     * Lists all Provider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProviderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Provider model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id=null, $proname=null)
    {
        $this->layout = '//profile';

        if (isset($id)) {
            $provider = $this->loadModel($id);
            $model = $provider->user;
        }               
        else if (isset($proname)) {
            $model = User::find()->where(['username'=>$proname])->one();
        }

        if ($model===null)
            $this->redirect(Yii::$app->request->baseUrl.'/providers');

        if ($model) {

            $provider = $model->provider;
            
            return $this->render('view', [
                'model' => $model,
                'provider' => $provider,
            ]);
        }        
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionBids($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $searchModel = new BidsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('bids', [
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
    public function actionPresentations($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $searchModel = new PresentationsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('presentations', [
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
    public function actionPromotions($username=null)
    {
        $this->layout = '//user_list';

        if(isset($username)) {
            $user = $this->findModelByUsername($username);

            if($user) {
                $searchModel = new PromotionsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('promotions', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'user' => $user,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }

    /**
     * Creates a new Provider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Provider();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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

            if($model and $model->provider) {
                $details = $model->details;
                $locationHQ = $model->location;
                $provider = $model->provider;
                $portfolio = $provider->portfolio;
                $certification = new \common\models\ProviderPortfolioCertifications();
                $education = new \common\models\ProviderPortfolioEducations();
                $experience = new \common\models\ProviderPortfolioExperience();
                $portfolio_images = new \common\models\ProviderPortfolioFiles();
                $publication = new \common\models\ProviderPortfolioPublications();
                $licence = new \common\models\ProviderLicences();
                $openingHours = new \common\models\ProviderOpeningHours();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'details' => $details,
                        'provider' => $provider,
                        'locationHQ' => $locationHQ,
                        'portfolio' => $portfolio,
                        'certification' => $certification,
                        'education' => $education,
                        'experience' => $experience,
                        'portfolio_images' => $portfolio_images,
                        'publication' => $publication,
                        'openingHours' => $openingHours,
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
     * Deletes an existing Provider model.
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
     * Finds the Provider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Provider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Provider::findOne($id)) !== null) {
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
