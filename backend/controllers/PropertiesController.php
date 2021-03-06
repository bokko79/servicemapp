<?php

namespace backend\controllers;

use Yii;
use common\models\CsProperties;
use common\models\CsPropertiesTranslation;
use common\models\CsPropertiesSearch;
use common\models\CsPropertyValues;
use common\models\CsObjectProperties;
use common\models\CsActionProperties;
use common\models\CsIndustryProperties;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * PropertiesController implements the CRUD actions for CsProperties model.
 */
class PropertiesController extends Controller
{
    public $layout = '/admin';
    
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
     * Lists all CsProperties models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsPropertiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsProperties model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'propertyValues' => new ActiveDataProvider([
                'query' => CsPropertyValues::find()->filterWhere(['property_id' => $id]),
            ]),
            'industryProperties' => new ActiveDataProvider([
                'query' => CsIndustryProperties::find()->filterWhere(['property_id' => $id]),
            ]),
            'actionProperties' => new ActiveDataProvider([
                'query' => CsActionProperties::find()->filterWhere(['property_id' => $id]),
            ]),
            'objectProperties' => new ActiveDataProvider([
                'query' => CsObjectProperties::find()->filterWhere(['property_id' => $id]),
            ]),
        ]);
    }

    /**
     * Creates a new CsProperties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CsProperties();
        $model_trans = new CsPropertiesTranslation();

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post()) and $model->save()) {
            $model_trans->property_id = $model->id;
            $model_trans->lang_code = 'SR';
            $model_trans->orig_name = $model->name;
            if($model_trans->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Updates an existing CsProperties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_trans = $model->translation;

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post()) and $model->save() and $model_trans->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Deletes an existing CsProperties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CsProperties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsProperties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsProperties::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
