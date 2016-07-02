<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsPropertyModels */

$this->title = 'Update Property Value: ' . ' ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => 'Property Vaulues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<h2><?= Html::encode($this->title) ?> <small>id: <?= $model->id ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>
