<?php

namespace frontend\controllers;

class IntroController extends \yii\web\Controller
{
	public $layout='intro';

    public function actionMain()
    {
        return $this->render('main');
    }

}
