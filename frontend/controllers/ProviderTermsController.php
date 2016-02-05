<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProviderTerms;
use frontend\models\ProviderTermsSearch;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProviderTermsController implements the CRUD actions for ProviderTerms model.
 */
class ProviderTermsController extends Controller
{
    public $layout='settings';
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProviderTerms models.
     * @return mixed
     */
    public function actionIndex($username=null)
    {
        if (isset($username)) {
            $user = User::find()->where(['username'=>$username])->one();
        }

        if($user) {
            $searchModel = new ProviderTermsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $this->redirect(Yii::$app->request->baseUrl.'/providers');
        }
    }

    /**
     * Displays a single ProviderTerms model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProviderTerms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProviderTerms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->provider_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProviderTerms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($username=null)
    {
        if (isset($username)) {
            $user = User::find()->where(['username'=>$username])->one();
        }

        if($user) {
            $model = $user->provider->providerTerms;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->provider_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            $this->redirect(Yii::$app->request->baseUrl.'/providers');
        }
    }

    /**
     * Deletes an existing ProviderTerms model.
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
     * Finds the ProviderTerms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProviderTerms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProviderTerms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
