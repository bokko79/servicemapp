<?php

namespace frontend\controllers;

use Yii;
use common\models\CsObjects;
use common\models\CsObjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjectsController implements the CRUD actions for CsObjects model.
 */
class ObjectsController extends Controller
{
    public $layout='index_service';
    
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
     * Lists all CsObjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsObjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsObjects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title=null)
    {
        if (isset($title)) {
            $obj_tr = $this->findModelByTitle($title);
            // ako je našao ime usluge, renderuj stranicu - URL injection
            if ($obj_tr)
            {
                $model = $this->findModel($obj_tr->object_id);

                return $this->render('view', [
                    'model' => $model,
                ]);
            }        
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    /**
     * Finds the CsObjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
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

    /**
     * Finds the CsServicesTranslation model based on its translated title.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByTitle($title)
    {
        if (($model = \common\models\CsObjectsTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
