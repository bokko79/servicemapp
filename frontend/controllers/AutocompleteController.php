<?php

namespace frontend\controllers;

class AutocompleteController extends \yii\web\Controller
{
    public function actionListActServices()
    {
        return $this->render('list-act-services');
    }

    public function actionListIndActions()
    {
        return $this->render('list-ind-actions');
    }

    public function actionListServices($q = null, $id = null)
    {        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('id, name AS text')
                ->from('cs_services')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => frontend\models\CsServices::find($id)->name];
        }
        return $out;
    }

    // THE CONTROLLER
    public function actionListIndustries($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('ser.id, ind.name AS industry, ser.name AS service')
                ->from('cs_industries AS ind')
                ->innerJoin('cs_services AS ser', 'ser.industry_id=ind.id')
                ->where(['like', 'ind.name', $q])
                ->where(['like', 'ser.name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => frontend\models\CsIndustries::find($id)->name];
        }
        return $out;
    }

}
