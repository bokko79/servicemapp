<?php

use yii\helpers\Html;

$this->title = 'Update Object Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Object Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= Html::encode($this->title) ?> <small>id: <?= $model->id ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>
