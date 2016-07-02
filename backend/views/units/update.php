<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnits */

$this->title = 'Update Unit: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= Html::encode($this->title) ?> <small>type: <?= $model->type ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>
