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
use yii\data\ActiveDataProvider;

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
        $model = $this->findModel($id);
        $query = \common\models\CsObjectProperties::find()->where(['object_id' => $model->id]);
            
        if($model->getPath($model)){
            foreach ($model->getPath($model) as $key => $objectpp) {
                if($objectPropertiespp = $objectpp->objectProperties){
                    foreach($objectPropertiespp as $objectPropertypp){
                        if($objectPropertypp->property_class!='private'){
                            $query->orWhere(['object_id' => $objectpp->id]);
                        }
                    }
                }              
            }
        }

        return $this->render('view', [
            'model' => $model,
            'products' => new ActiveDataProvider([
                'query' => \common\models\CsProducts::find()->where(['object_id' => $model->id]),
            ]),
            'issues' => new ActiveDataProvider([
                'query' => \common\models\CsObjectIssues::find()->where(['object_id' => $model->id]),
            ]),
            'properties' => new ActiveDataProvider([
                'query' => $query->orderBy('property_type')->groupBy('id'),
            ]),
            'methods' => new ActiveDataProvider([
                'query' => \common\models\CsServices::find()->where(['object_id' => $model->id]),
            ]),
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

        if($objects = Yii::$app->request->get('CsObjects')){
            $model->object_id = !empty($objects['object_id']) ? $objects['object_id'] : null;
            $model->object_type_id = !empty($objects['object_type_id']) ? $objects['object_type_id'] : null;
        }

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

            //$parent = $this->findModel($model->object_id);
            //$model->level = $parent->level + 1;

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            $model->save();

            if ($model->imageFile and $image = $model->upload()) {
                $model->file_id = $image->id;
            }

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

    public function actionAjaxCreate() 
    {
        $model = new CsObjects();
        $model_trans = new CsObjectsTranslation();
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $id]);
        } 
        //if (Yii::$app->request->isAjax) {
            return $this->renderPartial('/objects/_form', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        //}
    }

    public function actionAjaxUpdate($id) 
    {
        $model = $this->findModel($id);
        $model_trans = $model->translation;
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $id]);
        } 
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
                'model_trans' => $model_trans,
            ]);
        }
    }
}
