<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CsServices;
use frontend\models\CsServicesSearch;
use frontend\models\CsObjects;
use frontend\models\CsIndustries;
use frontend\models\CsActions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\Session;
use yii\data\ActiveDataProvider;

/**
 * ServicesController implements the CRUD actions for CsServices model.
 */
class ServicesController extends Controller
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
     * Lists all CsServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;

        //$session->removeAll();

        if($state = $request->get('st')){            
            $session->set('state', $state);
            if($state=='gl'){
                $session->remove('state');
            }
        }
        $q = $request->get('q');
        $queryObjects = ($q) ? CsObjects::find()->where(['like', 'name', $q])->all() : null;
        $queryIndustries = ($q) ? CsIndustries::find()->where(['like', 'name', $q])->all() : null;
        $queryActions = ($q) ? CsActions::find()->where(['like', 'name', $q])->all() : null;
        $object = ($request_O = $request->get('o')) ? CsObjects::findOne($request_O) : null;
        $industry = ($request_I = $request->get('i')) ? CsIndustries::findOne($request_I) : null;
        $action = ($request_A = $request->get('a')) ? CsActions::findOne($request_A) : null;

        $renderIndex = $object || $industry || $action || $q ? false : true;
        
        $searchModel = new CsServicesSearch();
        $dataProvider = $searchModel->search(['CsServicesSearch'=>['name'=>$q]]);
        
        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'renderIndex' => $renderIndex,
            'industry' => $industry,
            'action' => $action,
            'object' => $object, 
            'searchString' => $request->get('q'),           
            'queryObjects' => $queryObjects,
            'queryIndustries' => $queryIndustries,
            'queryActions' => $queryActions, 
        ]);
    }

    /**
     * Displays a single CsServices model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title=null)
    {
        $this->layout = '//profile';

        if (isset($title)) {
            $ser_tr = $this->findModelByTitle($title);
            // ako je našao ime usluge, renderuj stranicu - URL injection
            if ($ser_tr)
            {
                $model = $this->findModel($ser_tr->service_id);

                return $this->render('view', [
                    'model' => $model,
                ]);
            }        
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }        
    }

    /**
     * Lists all CsServices models.
     * @return mixed
     */
    public function actionAdd()
    {
        $searchModel = new CsServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the CsServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsServices::findOne($id)) !== null) {
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
        if (($model = \common\models\CsServicesTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionObjectModelsPresent($id=null)
    {
        if($id){
            if($service = $this->findModel($id)) {
                return $this->renderAjax('//services/_object_models-present', [
                    'model' => $service,
                    'object' => $service->object,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionObjectModelsOrder($id=null)
    {
        if($id){
            if($service = $this->findModel($id)) {
                return $this->renderAjax('//services/_object_models', [
                    'model' => $service,
                    'object' => $service->object,
                ]);
            }
        }
        return;            
    }
}
