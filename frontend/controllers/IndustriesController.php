<?php

namespace frontend\controllers;

use Yii;
use common\models\CsIndustries;
use common\models\CsIndustriesSearch;
use common\models\CsServices;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * IndustriesController implements the CRUD actions for CsIndustries model.
 */
class IndustriesController extends Controller
{
    public $layout='index';

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
     * Lists all CsIndustries models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsIndustriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsIndustries model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title=null)
    {
        if (isset($title)) {
            
            $this->layout = '//index_service';

            $ind_tr = $this->findModelByTitle($title);
            // ako je našao ime usluge, renderuj stranicu - URL injection
            if ($ind_tr)
            {
                $model = $this->findModel($ind_tr->industry_id);

                $dataProvider_services = new ActiveDataProvider([
                    'query' => CsServices::find()
                                ->where('industry_id='.$model->id),
                ]);
                $dataProvider_presentations = new ActiveDataProvider([
                    'query' => CsServices::find()
                                ->where('industry_id='.$model->id),
                ]);
                $dataProvider_promotions = new ActiveDataProvider([
                    'query' => CsServices::find()
                                ->where('industry_id='.$model->id),
                ]);
                $dataProvider_orders = new ActiveDataProvider([
                    'query' => CsServices::find()
                                ->where('industry_id='.$model->id),
                ]);
                $dataProvider_providers = new ActiveDataProvider([
                    'query' => CsServices::find()
                                ->where('industry_id='.$model->id),
                ]);

                return $this->render('view', [
                    'model' => $model,
                    'dataProvider_services' => $dataProvider_services,
                    'dataProvider_presentations' => $dataProvider_presentations,
                    'dataProvider_promotions' => $dataProvider_promotions,
                    'dataProvider_orders' => $dataProvider_orders,
                    'dataProvider_providers' => $dataProvider_providers,
                ]);
            }        
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the CsIndustries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsIndustries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsIndustries::findOne($id)) !== null) {
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
        if (($model = \common\models\CsIndustriesTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
