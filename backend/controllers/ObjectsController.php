<?php

namespace backend\controllers;

use Yii;
use common\models\CsObjects;
use common\models\CsObjectsSearch;
use common\models\CsObjectsTranslation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ObjectsController implements the CRUD actions for CsObjects model.
 */
class ObjectsController extends Controller
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
     * Lists all CsObjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CsObjects();
        $searchModel = new CsObjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single CsObjects model.
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
     * Creates a new CsObjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CsObjects();
        $model_trans = new CsObjectsTranslation();

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post())) {
            $parent = $this->findModel($model->object_id);
            $model->level = $parent->level + 1;
            if($model->save()){
                if ($model->imageFile) {
                    $model->upload();
                }
                $model_trans->object_id = $model->id;
                $model_trans->orig_name = $model->name;
                $model_trans->save();
                //if($model_trans->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                //}
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Updates an existing CsObjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_trans = $model->translation;

        if ($model->load(Yii::$app->request->post()) and $model_trans->load(Yii::$app->request->post())) {

            $parent = $this->findModel($model->object_id);
            $model->level = $parent->level + 1;

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            $model->save();

            if ($model->imageFile and $image = $model->upload()) {
                $model->image_id = $image->id;
                //$model->save();
            }

            $model_trans->save();

            //echo '<pre>';
            //print_r($model);
            //echo '</pre>'; die();

            return $this->redirect(['view', 'id' => $model->id]);
                
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Deletes an existing CsObjects model.
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
     * Finds the CsObjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CsObjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsObjects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
