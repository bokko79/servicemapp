<?php

namespace frontend\controllers;


class GlobalNavController extends \yii\web\Controller
{
    public function actionGlobIndSer()
    {
        return $this->renderPartial('glob-ind-ser');
    }

    public function actionGlobNavEventsBody()
    {
        return $this->renderPartial('glob-nav-events-body');
    }

    public function actionGlobNavEventsHead()
    {
        return $this->renderPartial('glob-nav-events-head');
    }

    public function actionGlobNavMarketBody()
    {
        return $this->renderPartial('glob-nav-market-body');
    }

    public function actionGlobNavMarketHead()
    {
        return $this->renderPartial('glob-nav-market-head');
    }

    public function actionGlobNavProvidersBody()
    {
        return $this->renderPartial('glob-nav-providers-body');
    }

    public function actionGlobNavProvidersHead()
    {
        return $this->renderPartial('glob-nav-providers-head');
    }

    public function actionGlobNavServicesBody()
    {
        return $this->renderPartial('glob-nav-services-body');
    }

    public function actionGlobNavServicesHead()
    {
        return $this->renderPartial('glob-nav-services-head');
    }

    public function actionInd($id)
    {
        $sek = \frontend\models\CsSectors::findOne($id);
        return $this->renderPartial('industry-popup', ['sek'=>$sek]);
    }

    public function actionGetid()
    {
        $id= isset($_POST['lastChar']) ? $_POST['lastChar'] : '';
        return '/ind/'.$id;
    }

    public function actionListActServices()
    {
        return $this->renderPartial('list-act-services');
    }

    public function actionListIndActions()
    {
        return $this->renderPartial('list-ind-actions');
    }

    public function actionActServices()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $query = \frontend\models\CsActions::find()->where('industry_id ='.$cat_id)->asArray()->all();
                foreach ($query as $key=>$value){
                    unset($query[$key]['industry_id'], 
                            $query[$key]['object_mode'], 
                            $query[$key]['status'], 
                            $query[$key]['added_by'], 
                            $query[$key]['added_time'],
                            $query[$key]['description']);
                }
                
                $out = $query;
                //print_r($query); die();
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionServiceObjects()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                //$query = \frontend\models\CsServices::find()->where('action_id='.$cat_id)->asArray()->all();
                $query = new \yii\db\Query;
                // compose the query
                $query->select('cs_objects.id, cs_objects.name')
                    ->from('cs_objects')
                    ->innerJoin('cs_services', 'cs_services.object_id = cs_objects.id')
                    ->where('cs_services.action_id='.$cat_id);
                // build and execute the query
                $rows = $query->all();
                $out = $rows;

                //print_r($rows); die();
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }
}
