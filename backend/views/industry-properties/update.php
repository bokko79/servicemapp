<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsSkills */

$this->title = 'Update Industry Property: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Industry Property', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

