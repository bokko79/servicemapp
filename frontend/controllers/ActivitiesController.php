<?php

namespace frontend\controllers;

use Yii;
use common\models\Activities;
use common\models\ActivitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\Session;

/**
 * ActivitiesController implements the CRUD actions for Activities model.
 */
class ActivitiesController extends Controller
{
    public $layout='market';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            /*'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->getIsOwner();
                        },
                    ],
                ],
            ],*/
        ];
    }

    /**
     * Lists all Activities models. Market.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;        
        $invite_hash = $request->get('inv');
        if($invite_hash!=null){
            $session = Yii::$app->session;
            $session->set('invite', $invite_hash);
        }        

        $searchModel = new ActivitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*if (isset($_REQUEST['CsServices']['industry_id']) && isset($_REQUEST['CsServices']['action_id']) && isset($_REQUEST['CsServices']['object_id'])){
            $service = \common\models\CsServices::find()->where('industry_id='.$_REQUEST['CsServices']['industry_id'].' and action_id='.$_REQUEST['CsServices']['action_id'].' and object_id='.$_REQUEST['CsServices']['object_id'])->one();
            //print_r($service); die();
            return $this->redirect('/add/'.mb_strtolower(str_replace(' ', '-', $service->name)));
        }  */      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    /**
     * Finds the Activities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Activities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
