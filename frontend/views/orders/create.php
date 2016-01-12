<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = Yii::t('app', 'Create Orders');
$this->pageTitle = [
		'icon' => '',
		'title' => $this->title,
		'description' => '',
	];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

