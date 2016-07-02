<?php

namespace frontend\controllers;

use Yii;
use common\models\ProviderIndustries;
use common\models\ProviderIndustriesSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProviderIndustriesController implements the CRUD actions for ProviderIndustries model.
 */
class ProviderIndustriesController extends Controller
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
     * Lists all ProviderIndustries models.
     * @return mixed
     */
    public function actionIndex($username=null)
    {
        if (isset($username)) {
            $user = User::find()->where(['username'=>$username])->one();
        }

        if($user) {
            $this->layout = '//user_list';

            $searchModel = new ProviderIndustriesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'user' => $user,
            ]);
        } else {
            $this->redirect(Yii::$app->request->baseUrl.'/providers');
        }
    }

    /**
     * Creates a new ProviderIndustries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProviderIndustries();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProviderIndustries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProviderIndustries model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMain($id)
    {
        $provider_industry = $this->findModel($id);
        $provider = $provider_industry->provider;
        if($provider->industries){
            foreach($provider->industries as $pro_ind){
                if($pro_ind->main==1){
                    $pro_ind->main=0;
                    $pro_ind->save();
                    break;
                }
            } 
        }
            
        $provider_industry->main = 1;
        $provider_industry->save();

        $provider->industry_id = $provider_industry->industry_id;
        $provider->save();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the ProviderIndustries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProviderIndustries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProviderIndustries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
