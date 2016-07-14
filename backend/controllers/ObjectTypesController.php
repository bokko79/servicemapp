<?php

namespace backend\controllers;

use Yii;
use common\models\CsObjectTypes;
use common\models\CsObjectTypesSearch;
use common\models\CsObjectTypesTranslation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ObjectTypesController implements the CRUD actions for CsObjectTypes model.
 */
class ObjectTypesController extends Controller
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
     * Lists all CsObjectTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsObjectTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsObjectTypes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'objects' => new ActiveDataProvider([
                'query' => \common\models\CsObjects::find()->where(['object_type_id' => $id]),
            ]),
        ]);
    }

    /**
     * Creates a new CsObjectTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CsObjectTypes();
        $model_trans = new CsObjectTypesTranslation();

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post())) {
            
            if($model->save()){                
                $model_trans->object_type_id = $model->id;
                $model_trans->orig_name = $model->name;
                $model_trans->save();

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
     * Updates an existing CsObjectTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_trans = $model->translation;

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post())) {
            
            $model->save();
            $model_trans->save();

            return $this->redirect(['view', 'id' => $model->id]);
                
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Deletes an existing CsObjectTypes model.
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
     * Finds the CsObjectTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsObjectTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsObjectTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
