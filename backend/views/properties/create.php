<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProperties */

$this->title = 'Create New Property';
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Novo svojstvo</small></h2>

<?= $this->render('_form', [
	'model' => $model,
	'model_trans' => $model_trans,
]) ?>

