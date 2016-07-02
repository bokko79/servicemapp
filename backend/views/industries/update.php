<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsIndustries */

$this->title = 'Update Industry: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<h2><?= Html::encode($this->title) ?> <small>status: <?= $model->status ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>

