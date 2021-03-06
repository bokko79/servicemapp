<?php

namespace backend\controllers;

use Yii;
use common\models\CsObjectProperties;
use common\models\CsObjectPropertiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ObjectPropertiesController implements the CRUD actions for CsObjectProperties model.
 */
class ObjectPropertiesController extends Controller
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
     * Lists all CsObjectProperties models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsObjectPropertiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsObjectProperties model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'propertyValues' => new ActiveDataProvider([
                'query' => \common\models\CsObjectPropertyValues::find()->where(['object_property_id' => $id]),
            ]),
        ]);
    }

    /**
     * Creates a new CsObjectProperties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CsObjectProperties();
        if($objectProperties = Yii::$app->request->get('CsObjectProperties')){
            $model->object_id = !empty($objectProperties['object_id']) ? $objectProperties['object_id'] : null;
            $model->property_id = !empty($objectProperties['property_id']) ? $objectProperties['property_id'] : null;
            $model->property_unit_id = !empty($objectProperties['property_unit_id']) ? $objectProperties['property_unit_id'] : null;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CsObjectProperties model.
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
     * Deletes an existing CsObjectProperties model.
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
     * Finds the CsObjectProperties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CsObjectProperties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsObjectProperties::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionModal($id=null)
    {
        if($id){
            if($objectProperty = $this->findModel($id)) {
                return $this->renderAjax('//objects/_object_property_values', [
                    'model' => $objectProperty,
                    'object' => $objectProperty->object,
                ]);
            }
        }
        return;            
    }
}
