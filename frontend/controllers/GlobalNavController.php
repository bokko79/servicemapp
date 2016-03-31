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
        $id = isset($_POST['lastChar']) ? $_POST['lastChar'] : '';
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
    
}
